<?php

/**
 * 文章管理Model
 */
class ArticleModel extends \BaseModel {

    /**
     * 保存文章
     */
    public function saveArticleDataInfo($paramList) {
        $dataId = $paramList['dataid'];
        $dataType = $paramList['datatype'];
        $article = $paramList['article'];
        $content = $paramList['content'];
        $hotelid = $paramList['hotelid'];

        $articleTypeList = Enum_Article::getArticleTypeList();
        do {
            $dataType = explode('_', $dataType);
            $articleConfig = $articleTypeList[$dataType[0]];
            if (empty($articleConfig) || empty($dataType[1]) || empty($dataId)) {
                $result = array(
                    'code' => 1,
                    'msg' => '参数错误'
                );
                break;
            }

            $tmpfname = tempnam(sys_get_temp_dir(), "easyiservice");
            $handle = fopen($tmpfname, "w");
            fwrite($handle, $content);
            fclose($handle);
            $uploadReslut = $this->uploadFile(array('tmp_name' => $tmpfname, 'name' => 'article.html'), Enum_Oss::OSS_PATH_HTML, $article);
            if ($uploadReslut['code'] || $article) {
                $result = $uploadReslut;
                break;
            } else {
                $params = array();
                $params['id'] = $dataId;
                $params['hotelid'] = $hotelid;
                $params[$articleConfig['field'] . $dataType[1]] = $uploadReslut['data']['picKey'];
                $result = $this->rpcClient->getResultRaw($articleConfig['interfaceId'], $params);
            }
        } while (false);
        $tmpfname && unlink($tmpfname);
        return $result;
    }
}
