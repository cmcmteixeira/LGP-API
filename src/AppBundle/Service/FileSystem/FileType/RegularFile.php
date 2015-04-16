<?php
/**
 * Created by IntelliJ IDEA.
 * User: carlos
 * Date: 15/04/2015
 * Time: 18:19
 */

namespace AppBundle\Service\FileSystem\FileType;


class RegularFile extends AbstractFile{

    function save($path = false)
    {
       $this->fs->copy($this->filePath,$path);
    }

    function remove($path = false)
    {
        $this->fs->remove($this->filePath);
    }

    function toFile()
    {
       return new File($this->filePath);
    }
}