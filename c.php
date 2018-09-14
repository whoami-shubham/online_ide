
<?php
header('Content-Type: text/html; charset=utf-8');
#
# && isset( $_POST['checkbox'] )
#
#ini_set('memory_limit', '1M');
function c_compiler(){

	if( isset( $_POST['code'] ) ){

				$code = $_POST['code'];

				if( isset( $_POST['in'] )  ){

				 			$input = $_POST['in'];
				   }
				$main = "main.c";
				$c = "code.c";
				$error_file = "error.txt";
				$command = "gcc -lm $main -w 2> ".$error_file;
				$run = "timeout 5s ./a.out";
				$file_to_save = fopen($c, "w+");
				fwrite( $file_to_save, $code );
				fclose( $file_to_save);
$f =fopen($main,"w+");
$d = <<<EOD
#include<stdlib.h>
#include<unistd.h>
#define system  <stdlib.h>
#define exec   <unistd.h>
\n
EOD;
fwrite($f,$d);
fclose($f);     
                shell_exec("cat $c>>$main");
				shell_exec( "chmod 777 $main" );
      			$output_file = fopen( "output.txt", "w+" );
				shell_exec( "chmod 777 output.txt" );
				fclose( $output_file );
				error_reporting( 0 );

				/**
				 * custom exception class for user friendly error messages
				 */

				// function catch_fatal_error(){
				// 			$last_error = error_get_last();
				// 			if ( isset( $last_error['type'] ) ){
				// 						log_exception( new Exception() );
				// 		      }
				// }

				// function log_exception( Exception $e ){
				   
				// 	   if( isset( $e ) ){
				// 			       echo 'Fatal error occured ';
				// 		}
				// 		else{
				// 	      		echo "some Exception  occured ";

				// 		}

				// }

				// set_error_handler( "catch_fatal_error" );
				// set_exception_handler( "log_exception" );
				// register_shutdown_function( "catch_fatal_error" );

				shell_exec( $command );
				shell_exec( "chmod 777 a.out" );
				$executionStartTime = microtime( true );
				if( filesize( 'error.txt' )==0 ){
					
						$input_file = fopen( 'input.txt', "w+" );
						shell_exec( "chmod 777 output.txt" );
						if( isset( $input ) ){

							fwrite( $input_file, $input );
							$run = $run.' < input.txt ';
						 }
						fclose( $input_file );

					    $run = $run." >"."output.txt";
							//echo $run;


						shell_exec( $run );   
						//$executionEndTime = microtime( true );
						//$seconds = $executionEndTime - $executionStartTime;
						//$seconds = $seconds;
						
						//echo '<div style="height:auto;width:100%;text-align:center;" id="tm">';
						//echo "Memory Uses :".number_format(memory_get_usage()/1024,2) . " kb <br>";
						//echo 'execution Time : '.number_format( $seconds,2 ).'s';

                       // echo '</div>';
						
						//echo '<textarea id="out" onclick="myFunction()" readonly style="width:100%;">';
						// if(!filesize('output.txt')>134217728){
      //                         echo file_get_contents('output.txt');
      //                     }
						// else{
						//  echo 'Memory limit exceeded !';

						//  }
						echo file_get_contents('output.txt');

						//echo '</textarea>';
                         exec('rm output.txt');
                         exec("rm input.txt");

				}
				else{
					   	echo trim( file_get_contents( 'error.txt' ) );
				   }
		}
}
c_compiler();
?>
