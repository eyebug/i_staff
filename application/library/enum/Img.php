<?php

class Enum_Img {

    // 阿里云图片服务地址
    const OSS_IMGURL = '//storage.easyiservice.com';

    const PIC_TYPE_KEY_WIDTH750 = 'width_750';


    /**
     * 根据key和类型获取图片路径
     *
     * @param string $picId
     * @param
     *            int addLogo 1代表添加，0代表不添加
     * @return string|multitype:string
     */
    public static function getPathByKeyAndType($picId, $imgType = "") {
        $url = '';
        if (!empty($picId)) {
            $picId = str_replace(array(
                "_",
                "//"
            ), "/", $picId);
            $picIdIndex = $picId[0];
            $idel = $picIdIndex == '/' ? '' : '/';
            $url = self::OSS_IMGURL . $idel . $picId . ($imgType ? '!' . $imgType : '');
        }
        return $url;
    }

}
