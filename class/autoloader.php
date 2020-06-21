<?php


class Autoloader{


    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload( $class, $dir = null ) {

        if ( is_null( $dir ) )
        $dir = PATH_FOLDER;

            foreach ( scandir( $dir ) as $file )
            {

                // directory?
                if ( is_dir( $dir.$file ) && substr( $file, 0, 1 ) !== '.' )
                    self::autoload( $class, $dir.$file.'/' );

                // php file?
                if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {

                    // filename matches class?
                    if ( str_replace( '.php', '', $file ) == $class || str_replace( '.class.php', '', $file ) == $class ) {

                         include $dir . $file;
                    }
                }
            }
    }



}


