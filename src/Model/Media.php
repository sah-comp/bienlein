<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * Media model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Media extends Model
{
    /**
     * Map to translate media extension to mime type.
     *
     * @var array
     */
    protected $extensions = array(
        'gif' => 'image/gif',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png'
    );

    /**
     * Container for exensions that qualify as image files.
     *
     * @var array
     */
    protected $extensions_image = array(
        'jpg',
        'gif',
        'jpeg',
        'jpg',
        'png'
    );
    
    /**
     * Returns the media file name.
     *
     * @return string
     */
    public function getPrintableName()
    {
        return $this->name;
    }
    
    /**
     * Returns wether the uploaded file is an image file or not.
     *
     * Wether the file is an image or not is determined by testing the file extension the time being.
     *
     * @todo Implement a better image check using getimagesize()
     *
     * @return bool
     */
    public function isImage()
    {
        return in_array($this->bean->extension, $this->extensions_image);
    }
    
    /**
     * Returns an textile image tag.
     *
     * @return string
     */
    public function imageAsTextile()
    {
        return sprintf("!%s/%s(%s)!", Flight::get('media_path'), $this->bean->file, $this->bean->name);
    }

    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'sanename',
                'sort' => array(
                    'name' => 'media.sanename'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'extension',
                'sort' => array(
                    'name' => 'media.extension'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'size',
                'sort' => array(
                    'name' => 'media.size'
                ),
                'class' => 'number',
                'filter' => array(
                    'tag' => 'number'
                )
            ),
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'media.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'desc',
                'sort' => array(
                    'name' => 'media.desc'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Returns a the given string safely to use as filename or url.
     *
     * @link http://stackoverflow.com/questions/2668854/sanitizing-strings-to-make-them-url-and-filename-safe
     *
     * What it does:
     * - Replace all weird characters with dashes
     * - Only allow one dash separator at a time (and make string lowercase)
     *
     * @param string $string the string to clean
     * @param bool $is_filename false will allow additional filename characters
     * @return string
     */
    public function sanitizeFilename($string = '', $is_filename = false)
    {
        $string = preg_replace('/[^\w\-'. ($is_filename ? '~_\.' : ''). ']+/u', '-', $string);
        return mb_strtolower(preg_replace('/--+/u', '-', $string));
    }
        
    /**
     * update.
     *
     * This will check for file uploads.
     */
    public function update()
    {
        $files = reset(Flight::request()->files);
        $file = reset($files);
        if ($this->bean->getId() && (empty($file) || $file['error'] == 4)) {
            
        }
        else
        {
            if ($file['error']) {
                $this->addError($file['error'], 'file');
                throw new Exception('fileupload error ' . $file['error']);
            }
            $file_parts = pathinfo($file['name']);
            $this->bean->sanename = $this->sanitizeFilename($file_parts['filename']);
            $this->bean->extension = strtolower($file_parts['extension']);
            if ( ! $this->bean->name) {
                $this->bean->name = ucfirst(strtolower($this->bean->sanename));
            }
            $this->bean->file = $this->bean->sanename.'.'.$this->bean->extension;
            if ( ! move_uploaded_file($file['tmp_name'], Flight::get('upload_dir') . '/' . $this->bean->file)) {
                $this->addError('move_upload_file_failed', 'file');
                throw new Exception('move_upload_file_failed');
            }
            $this->size = filesize(Flight::get('upload_dir') . '/' . $this->bean->file);
            $this->mime = $file['type'];
        }
        parent::update();
    }
    
    /**
     * after_delete.
     *
     * After the bean was deleted from the database, we will also delete the real file.
     *
     */
    public function after_delete()
    {
        if (is_file(Flight::get('upload_dir').'/'.$this->bean->file)) {
            unlink(Flight::get('upload_dir').'/'.$this->bean->file);
        }
    }
}
