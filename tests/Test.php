<?php
    use PHPUnit\Framework\TestCase;
    use App\includes\funtzioak;

    class Test extends TestCase {

        public function testEscape() {
            $keyword = "<script>alert('test')</script>";
            $sanitisazioa = htmlspecialchars($keyword, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
            $sanitisazioa = strip_tags($keyword);
            $this->assertEquals($sanitisazioa, "alert('test')");
        }

        public function testCheckImage(){
            $iamage = "logo.png";
            $formatos_permitidos = array('png','jpeg','jpg', 'gif');
            $extension = pathinfo($image,PATHINFO_EXTENSION);
            $resultado=false;
            if(!in_array($extension, $formatos_permitidos)){
                $resultado=true;
            }
            $this->assertEquals($resultado, false);
        }

        public function testCheckEmail(){
            $email = "aitormugira8@gmail.com";
            $resultado=false;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return false;
			}
            $this->assertEquals($resultado, true);
        }
    }
?>