<?php

/**
 * http2 headers
 *
 * @package    Autoptimize-beta
 * @author     percipero <chris@percipero.com>
 * 
 * derived from http_push_content
 * by:    piwebsolution <rajeshsingh520@gmail.com>
 * 
 */
if(!class_exists("autoptimizeHttp2")){
    
    class autoptimizeHttp2 {
        
        static function createHeader( $type, $src ) {
            
    		if (strpos($src, site_url()) !== false) {
    	
    	
    			if (!empty($src) && !empty($type)) {
    		
                    if ( $type == 'script') {
                        $header = sprintf(
        						'Link: <%s>; rel=preload; as=%s',
        						esc_url( self::http2_link_to_relative_path($src) ), 
        						'script'
        					);
                        /**
                        if ( stripos($payload, 'autoptimize_') > 0 )
                            wp_dequeue_script( basename($src) );
                        else {
                            $this->debug_log( "dequeue: ".$src );
                        }
                        **/
                    } else {
                        $header = sprintf(
        						'Link: <%s>; rel=preload; as=%s',
        						esc_url( self::http2_link_to_relative_path($src) ), 
        						'link'
        					);
                        /**
                        if ( stripos($payload, 'autoptimize_') > 0 )
                            wp_dequeue_style( basename($src) );
                        else {
                            $this->debug_log( "dequeue: ".$src );
                        }
                        **/
                    }
                    header( $header, false );
                    			
    			}
    	
    		}
    	
        }
        /**
    	 * Convert an URL to a relative path
    	 *
    	 */
    	static function http2_link_to_relative_path($src) {
    		return '//' === substr($src, 0, 2) ? preg_replace('/^\/\/([^\/]*)\//', '/', $src) : preg_replace('/^http(s)?:\/\/[^\/]*/', '', $src);
    	
        }
    }
	

}
