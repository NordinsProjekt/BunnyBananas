<?php
class UploadController
{
    function AddProductImage($productId)
    {
        if ($productId == "" || $productId <=0)
        {
            $_SESSION['Message'] = "Något är fel med Produkt ID";
            return false;
        }

        $target_dir = "img/products/" .$productId . "/";
        $this->CreateFolder($target_dir);
        $file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if($this->CheckFileExists($file))
        {
            if($this->CheckFileSize($file))
            {
                if($this->CheckFileFormat($file))
                {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file))
                    {
                        $_SESSION['Message'] = "File". $file . "has been uploaded";
                    }
                    else
                    {
                        $_SESSION['Message'] = "Unknown error, could not upload";
                    }
                }
                else
                {
                    $_SESSION['Message'] = "Wrong fileformat";
                }
            }
            else
            {
                $_SESSION['Message'] = "File to big";
            }
        }
        else
        {
            $_SESSION['Message'] = "Filen finns redan, ".$file;

        }
    }

    function AddProfilePicture($userId)
    {
        if ($userId == "" || $userId <=0)
        {
            $_SESSION['Message'] = "Något är fel med Produkt ID";
            return false;
        }

        $target_dir = "img/products/" .$userId . "/";
        $this->CreateFolder($target_dir);
        $file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if($this->CheckFileExists($file))
        {
            if($this->CheckFileSize($file))
            {
                if($this->CheckFileFormat($file))
                {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file))
                    {
                        $_SESSION['Message'] = "File". $file . "has been uploaded";
                    }
                    else
                    {
                        $_SESSION['Message'] = "Unknown error, could not upload";
                    }
                }
                else
                {
                    $_SESSION['Message'] = "Wrong fileformat";
                }
            }
            else
            {
                $_SESSION['Message'] = "File to big";
            }
        }
        else
        {
            $_SESSION['Message'] = "Filen finns redan, ".$file;

        }
    }

    function CreateFolder($folder)
    {
        if (!file_exists($folder)) 
        { 
            mkdir($folder, 0777, true); 
        }
    }
    function CheckFileExists($file)
    {
        if (file_exists($file)) {
            return false;
        }
    }

    function CheckFileSize($file)
    {
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            return false;
        }
    }
    function CheckFileFormat($file)
    {
        $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          return false;
        }
    }
}
?>