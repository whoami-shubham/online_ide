
<?php
header('Content-Type: text/html; charset=utf-8');
#
# && isset( $_POST['checkbox'] )
#
#ini_set('memory_limit', '1M');
function js_interpreter(){

	if( isset( $_POST['code'] ) ){

				$code = $_POST['code'];

				if( isset( $_POST['in'] )  ){

				 			$input = $_POST['in'];
				   }
				   echo exec("ls -al");
                }
				
           }
js_interpreter();

?>
