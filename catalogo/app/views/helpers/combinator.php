<?php 
class CombinatorHelper extends Helper {
    var $helpers = array('Html','Javascript');
    var $Vue = null;
    var $libs = array('js' => array(), 'css' => array());
    var $inline_code = array('js' => array(), 'css' => array());
    var $basePath = null;
    var $cachePath = null;


    // default conf
    private $__options = array(
                            'js' => array(
                                'path' => '/js',
                                'cachePath' => '/js',
                                'enableCompression' => true
                            ),
                            'css' => array(
                                'path' => '/css',
                                'cachePath' => '/css',
                                'enableCompression' => false,
                                'compression' => 'high_compression' // Can be "high_compression", "highest_compression", "low_compression", or "default"
                            )
                        );

    function __construct($options = array()) {
        $this->__options['js'] = !empty($options['js'])?am($this->__options['js'], $options['js']):$this->__options['js'];
        $this->__options['css'] = !empty($options['css'])?am($this->__options['css'], $options['css']):$this->__options['css'];
        $this->Vue =& ClassRegistry::getObject('view');

        $this->__options['js']['path'] = $this->clean_path($this->__options['js']['path']);
        $this->__options['js']['cachePath'] = $this->clean_path($this->__options['js']['cachePath']);
        $this->__options['css']['path'] = $this->clean_path($this->__options['css']['path']);
        $this->__options['css']['cachePath'] = $this->clean_path($this->__options['css']['cachePath']);

        $this->basePath['js'] = WWW_ROOT.$this->__options['js']['path'];
        $this->cachePath['js'] = WWW_ROOT.$this->__options['js']['cachePath'];
        $this->basePath['css'] = WWW_ROOT.$this->__options['css']['path'];
        $this->cachePath['css'] = WWW_ROOT.$this->__options['css']['cachePath'];
    }

    function scripts($type) {
        switch($type) {
            case 'js':
                $cachefile_js = $this->generate_filename('js');
                return $this->get_js_html($cachefile_js);
            case 'css':
                $cachefile_css = $this->generate_filename('css');
                return $this->get_css_html($cachefile_css);
            default:
                $cachefile_js = $this->generate_filename('js');
                $output_js = $this->get_js_html($cachefile_js);
                $cachefile_css = $this->generate_filename('css');
                $output_css = $this->get_css_html($cachefile_css);
                return $output_css."\n".$cachefile_js;
        }
    }

    private function generate_filename($type) {
        $this->libs[$type] = array_unique($this->libs[$type]);

        // Create cache folder if not exist
        if(!file_exists($this->cachePath[$type])) {
            mkdir($this->cachePath[$type]);
        }

        // Define last modified to refresh cache if needed
        $lastmodified = 0;
        foreach($this->libs[$type] as $key => $lib) {
            $lib = $this->clean_lib_list($lib, $type);
            if(file_exists($this->basePath[$type].'/'.$lib)) {
                $lastmodified = max($lastmodified, filemtime($this->basePath[$type].'/'.$lib));
            }
            $this->libs[$type][$key] = $lib;
        }
        $hash = $lastmodified.'-'.md5(serialize($this->libs[$type]).'_'.serialize($this->inline_code[$type]));
        return 'cache-'.$hash.'.'.$type;
    }

    private function get_js_html($cachefile) {
        if (Configure::read('debug') > 0) {
            $ret = "";
            foreach($this->libs['js'] as $lib) {
                $ret .= $this->Javascript->link($lib);
            }
            return $ret;
        }
        if(file_exists($this->cachePath['js'].'/'.$cachefile)) {
            return  $this->Javascript->link($cachefile);
        }
        // Get the content
        $file_content = '';
        foreach($this->libs['js'] as $lib) {
            $file_content .= "\n\n".file_get_contents($this->basePath['js'].'/'.$lib);
        }

        // If compression is enable, compress it !
        if($this->__options['js']['enableCompression']) {
            App::import('Vendor', 'jsmin/jsmin');
            $file_content = trim(JSMin::minify($file_content));
        }

        // Get inline code if exist
        // Do it after jsmin to preserve variable's names
        if(!empty($this->inline_code['js'])) {
            foreach($this->inline_code['js'] as $inlineJs) {
                $file_content .= "\n\n".$inlineJs;
            }
        }

        if($fp = fopen($this->cachePath['js'].'/'.$cachefile, 'wb')) {
            fwrite($fp, $file_content);
            fclose($fp);
        }
        return  $this->Javascript->link($cachefile);
    }

    private function get_css_html($cachefile) {
        if (Configure::read('debug') > 0) {
            $ret = "";
            foreach($this->libs['css'] as $lib) {
                $ret .= $this->Html->css($lib);
            }
            return $ret;
        }
        if(file_exists($this->cachePath['css'].'/'.$cachefile)) {
            return $this->Html->css($cachefile);
        }
        // Get the content
        $file_content = '';
        foreach($this->libs['css'] as $lib) {
            $file_content .= "\n\n".file_get_contents($this->basePath['css'].'/'.$lib);
        }

        // Get inline code if exist
        if(!empty($this->inline_code['css'])) {
            foreach($this->inline_code['css'] as $inlineCss) {
                $file_content .= "\n\n".$inlineCss;
            }
        }

        // If compression is enable, compress it !
        if($this->__options['css']['enableCompression']) {
            App::import('Vendor', 'csstidy', array('file' => 'class.csstidy.php'));
            $tidy = new csstidy();
            $tidy->load_template($this->__options['css']['compression']);
            $tidy->set_cfg('sort_selectors', FALSE);
            $tidy->set_cfg('sort_properties', FALSE);
            $tidy->parse($file_content);
            $file_content = $tidy->print->plain();
        }

        if($fp = fopen($this->cachePath['css'].'/'.$cachefile, 'wb')) {
            fwrite($fp, $file_content);
            fclose($fp);
        }
        return $this->Html->css($cachefile);
    }

    function prepend_libs($type, $libs) {
        $tmplibs = $this->libs;
        $this->libs = array('js' => array(), 'css' => array());
        switch($type) {
            case 'js':
            case 'css':
                if(is_array($libs)) {
                    foreach($libs as $lib) {
                        $this->libs[$type][] = $lib;
                    }
                }else {
                    $this->libs[$type][] = $libs;
                }
                break;
            }           
        foreach($tmplibs['js'] as $lib) {
            $this->libs['js'][] = $lib;
        }
        foreach($tmplibs['css'] as $lib) {
           $this->libs['css'][] = $lib;
        }
    } 

    function add_libs($type, $libs) {
        switch($type) {
            case 'js':
            case 'css':
                if(is_array($libs)) {
                    foreach($libs as $lib) {
                        $this->libs[$type][] = $lib;
                    }
                }else {
                    $this->libs[$type][] = $libs;
                }
                break;
        }
    }

    function add_inline_code($type, $codes) {
        switch($type) {
            case 'js':
            case 'css':
                if(is_array($codes)) {
                    foreach($codes as $code) {
                        $this->inline_code[$type][] = $code;
                    }
                }else {
                    $this->inline_code[$type][] = $codes;
                }
                break;
        }
    }

    private function clean_lib_list($filename, $type) {
        if (strpos($filename, '?') === false) {
            if (strpos($filename, '.'.$type) === false) {
                $filename .= '.'.$type;
            }
        }

        return $filename;
    }

    private function clean_path($path) {
        // delete the / at the end of the path
        $len = strlen($path);
        if(strrpos($path, '/') == ($len - 1)) {
            $path = substr($path, 0, $len - 1);
        }

        // delete the / at the start of the path
        if(strpos($path, '/') == '0') {
            $path = substr($path, 1, $len);
        }
        return $path;
    }
}
?> 