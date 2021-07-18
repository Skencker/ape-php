<?php
    class Security{

        public static function verifAccessSession() {
            return (!empty($_SESSION['connect']) && $_SESSION['connect'] === 1 );
        }
    }

    //verification des inputs

    function veryfInput ($var) {
        $var = trim(stripslashes(htmlspecialchars($var))); 
        //enlever espace etc....
        //enlever les \
        //enlever le code html etc
        if (!empty($var)){
        return $var;
        }
        else return false;
    };


    // fonction verification image 

    function verifImage ($data) {
        global $isUploadSuccessImage;
        global $shaFileExtImage;
        $allowed = array("jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $data["name"];
        $filetype = $data["type"];
        $filesize = $data["size"];
        
        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) 
        $imageError = 'Veuillez sélectionner un format de fichier valide.';
        
        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) 
        $imageError = 'La taille du fichier est supérieure à la limite autorisée.';
        
        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
            $shaFile = hash('sha256', $data["name"]);
            $shaFileExtImage = $shaFile . "." . array_search($filetype, $allowed);
            move_uploaded_file($data["tmp_name"], "../images/" . $shaFileExtImage);
            echo "Votre fichier a été téléchargé avec succès.";
            $isUploadSuccessImage = true;          
            return $isUploadSuccessImage;
            
        } else{
            $isUploadSuccessImage = false;
            echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            return $isUploadSuccessImage ;
        }         
    }
    
    // fonction verification fichier
    
    function verifFichier($data) {
        global $isUploadSuccessFichier ;
        global $shaFileExtFichier;
        $allowed = array("pdf" => "application/pdf", "doc" => "application/doc", "docs" => "application/docs", "text" => "application/text");
        $filename = $data["name"];
        $filetype = $data["type"];
        $filesize = $data["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) 
            $imageError = 'Veuillez sélectionner un format de fichier valide.';

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) 
            $imageError = 'La taille du fichier est supérieure à la limite autorisée.';

        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
                $shaFile = hash('sha256', $data["name"]);

                $shaFileExtFichier = $shaFile . "." . $ext;
           
                move_uploaded_file($data["tmp_name"], "../doc/" . $shaFile . "." . array_search($filetype, $allowed));
                echo "Votre fichier a été téléchargé avec succès.";
                $isUploadSuccessFichier = true;
                return $isUploadSuccessFichier;
                
            } else {
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
                return $isUploadSuccessFichier;
        }
        
    }
            // creer fonction pour le token class user {}
?>
