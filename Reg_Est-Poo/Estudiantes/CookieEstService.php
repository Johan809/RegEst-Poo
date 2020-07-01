<?php
class CookieEstService implements IServicesBase{
    private $util;
    private $cookieName;
    
    public function __construct(){
        $this->util = new Util();
        $this->cookieName = 'estudiantes';
    }

    public function Read()
    {
        $ListEstudiantes = array();

        if(isset($_COOKIE[$this->cookieName])){
            $ListEstudiantesCoded = json_decode($_COOKIE[$this->cookieName], false);
            
            foreach($ListEstudiantesCoded as $item){
                $element = new Estudiante();
                $element->Set($item);
                array_push($ListEstudiantes,$element);
            }

        } else{
            setcookie($this->cookieName, json_encode($ListEstudiantes), $this->util->GetCookieTime(), "/");
        }

        return $ListEstudiantes;
    } #function

    public function GetById($id){
        $ListEstudiantes = $this->Read();
        $estudiante = $this->util->filtro($ListEstudiantes, 'id', $id)[0];

        return $estudiante;
    } #function

    public function Create($entity){
        $ListEstudiantes = $this->Read();
        $EstId = 1;

        if(!empty($ListEstudiantes)){
            $ultimoId = $this->util->IncrementarID($ListEstudiantes);
            $EstId = $ultimoId->id + 1;
        }

        $entity->id = $EstId;
        $entity->profilePic = '';

        if(isset($_FILES['profilePic'])){
            $pic = $_FILES['profilePic'];

            if($pic['error'] == 4){
                $entity->profilePic = '';
            } else{
                $typeReplace = str_replace("image/","",$pic['type']);
                $type = $pic['type'];
                $size = $pic['size'];
                $tmp = $pic['tmp_name'];
                $name = $EstId . '.' . $typeReplace; 
                $ok = $this->util->UpImage('../assets/img/estudiantes/',$name,$tmp,$type,$size);

                if($ok){
                    $entity->profilePic = $name;
                }
            }
        }

        array_push($ListEstudiantes,$entity);

        setcookie($this->cookieName, json_encode($ListEstudiantes), $this->util->GetCookieTime(), "/");
    } #function

    public function Update($id,$entity){
        $ListEstudiantes = $this->Read();
        $Est = $this->GetById($id);

        $EstIndex = $this->util->ItemIndex($ListEstudiantes,'id',$id);

        if(isset($_FILES['profilePic'])){

            $pic = $_FILES['profilePic'];

            if($pic['error'] == 4){
                $entity->profilePic = $Est->profilePic;
            } else{
                $typeReplace = str_replace("image/","",$pic['type']);
                $type = $pic['type'];
                $size = $pic['size'];
                $tmp = $pic['tmp_name'];
                $name = $id . '.' . $typeReplace; 
                $ok = $this->util->UpImage('../assets/img/estudiantes/',$name,$tmp,$type,$size);

                if($ok){
                    $entity->profilePic = $name;
                }
            }
            
        }

        $ListEstudiantes[$EstIndex] = $entity;

        setcookie($this->cookieName, json_encode($ListEstudiantes), $this->util->GetCookieTime(), "/");
    } #function

    public function Delete($id){
        $ListEstudiantes = $this->Read();
        $EstIndex = $this->util->ItemIndex($ListEstudiantes,'id',$id);
        unset($ListEstudiantes[$EstIndex]);

        $ListEstudiantes = array_values($ListEstudiantes); #para reorganizar los index's
        setcookie($this->cookieName, json_encode($ListEstudiantes), $this->util->GetCookieTime(), "/");
    }

} #Class

?>