<?php

/**
 * Exhibit attachment view helper.
 *
 * @package ExhibitBuilder\View\Helper
 */
class ExhibitBuilder_View_Helper_ExhibitAttachment extends Zend_View_Helper_Abstract
{
    /**
     * Return the markup for displaying an exhibit attachment.
     *
     * @param ExhibitBlockAttachment $attachment
     * @param array $fileOptions Array of options for file_markup
     * @param array $linkProps Array of options for exhibit_builder_link_to_exhibit_item
     * @param boolean $forceImage Whether to display the attachment as an image
     *  always Defaults to false.
     * @return string
     */
    public function exhibitAttachment($attachment, $fileOptions = array(), $linkProps = array(), $forceImage = false)
    {
        $item = $attachment->getItem();
        $file = $attachment->getFile();

        if ($file) {
            if (!isset($fileOptions['imgAttributes']['alt'])) {
                $fileOptions['imgAttributes']['alt'] = metadata($item, array('Dublin Core', 'Title'), array('no_escape' => true));
            }

            if($attachment['caption']):
              $caption = $attachment['caption'];
              $fileOptions['linkAttributes']['data-title'] = link_to_item($caption,$linkProps,'show',$item);// exhibit_builder_link_to_exhibit_item($caption, $linkProps, $item);
            else:
              $caption = "";
              $fileOptions['linkAttributes']['data-title'] = link_to_item(metadata($item, array('Dublin Core', 'Title')),$linkProps,'show',$item);

            endif;

            $fileOptions['linkAttributes']['data-lightbox'] = "set";
            $fileOptions['linkAttributes']['href'] = file_display_url($file);


            $html = file_markup($file, $fileOptions, null);
        } else if($item) {
            $html = exhibit_builder_link_to_exhibit_item(null, $linkProps, $item);
        }

        // Don't show a caption if we couldn't show the Item or File at all
        if (isset($html)) {
            $html .= $this->view->exhibitAttachmentCaption($attachment);
        } else {
            $html = '';
        }

        return apply_filters('exhibit_attachment_markup', $html,
            compact('attachment', 'fileOptions', 'linkProps', 'forceImage')
        );
    }

    /**
     * Return the markup for an attachment's caption.
     *
     * @param ExhibitBlockAttachment $attachment
     * @return string
     */
    protected function _caption($attachment)
    {
        if (!is_string($attachment['caption']) || $attachment['caption'] == '') {
            return '';
        }

        $html = '<div class="exhibit-item-caption">'
              . $attachment['caption']
              . '</div>';

        return apply_filters('exhibit_attachment_caption', $html, array(
            'attachment' => $attachment
        ));
    }
}
