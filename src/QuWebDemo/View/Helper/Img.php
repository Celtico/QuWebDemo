<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Get images
 * Extract path config QuPhpThumb
 */
class Img extends AbstractHelper
{

    protected $serviceLocator;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator){

        $this->serviceLocator = $serviceLocator;
    }


    public function __invoke($id,$size = 's')
    {
        $plupload = $this->serviceLocator->get('plupload_service');
        $config   = $this->serviceLocator->get('config');
        $pluploadConfig = $config['QuConfig']['QuPlupload'];

        $list    = '';
        $listDb  = $plupload->setPluploadIdAndModelList($id,'qu-web-demo');
        $listDb  = $listDb->getPluploadIdAndModelList();
        if(count($listDb) > 0){
            foreach($listDb as $a){}
            //str_replace('plupload','qu-web-demo',

            $file      = $pluploadConfig['DirUploadAbsolute'] . '/' . $a->getName();
            $url       = $pluploadConfig['DirUpload'] . '/'  . $a->getName();
            $urlSmall  = $pluploadConfig['DirUpload'] . '/' . $size . $a->getName();
            $ex        = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if(is_file($file)){

                if($ex == 'jpg' or $ex == 'jpeg' or $ex == 'gif' or $ex == 'png'){

                    $list .= '<img src="'.$urlSmall.'">';

                }else{

                    $list .= '<a href="'.$url.'" class="doc"></a>';
                }
            }
            return $list;
        }else{
            return false;
        }
    }

}
