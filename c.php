
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
				$error_file = "error.txt";
				$command = "gcc -lm $main -w 2> ".$error_file;
				$run = "timeout 0.5 ./a.out";
				$file_to_run = fopen($main, "w+");
				fwrite( $file_to_run, $code );
				fclose( $file_to_run );
				shell_exec( "chmod 777 $main" );
				$output_file = fopen( "output.txt", "w+" );
						shell_exec( "chmod 777 output.txt" );
						fclose( $output_file );

				error_reporting( 0 );

				/**
				 * custom exception class for user friendly error messages
				 */

				function catch_fatal_error(){
							$last_error = error_get_last();
							if ( isset( $last_error['type'] ) ){
										log_exception( new Exception() );
						      }
				}

				function log_exception( Exception $e ){
				   
					   if( isset( $e ) ){
							       echo 'RunTime error occured ';
						           
						
						}
						else{
					      		
                              echo file_get_contents('output.txt');

						}

				}

				set_error_handler( "catch_fatal_error" );
				set_exception_handler( "log_exception" );
				register_shutdown_function( "catch_fatal_error" );

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

					    $run = $run." > "."output.txt";
							//echo $run;


						shell_exec( $run );   
						$executionEndTime = microtime( true );
						$seconds = $executionEndTime - $executionStartTime;
						$seconds = $seconds;
						




						echo '<div style="height:auto;width:100%;text-align:center;" id="tm">';
						echo "Memory Uses :".number_format(memory_get_usage()/1024,2) . " kb <br>";
						echo 'execution Time : '.number_format( $seconds,2 ).'s';

                        echo '</div>';
						
						echo '<textarea id="out" onclick="myFunction()" readonly style="width:100%;">';
						echo file_get_contents('output.txt');
						echo '</textarea>';

				}
				else{
					   	echo '<code style="width:100%;">'.trim( file_get_contents( 'error.txt' ) ).'</code>';
				   }
		}
}
c_compiler();
?>