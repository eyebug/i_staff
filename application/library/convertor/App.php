<?php

/**
 * APP管理数据转换器
 */
class Convertor_App extends Convertor_Base {

    /**
     * 房间推送列表
     */
    public function roomPushListConvertor($list, $hotelId) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $userModel = new UserModel();
            $userList = $userModel->getList(array('hotelid' => $hotelId), 3600);
            $userList = array_column($userList['data']['list'], null, 'id');
            $platformList = $userModel->getPlatformList();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['type'] = $value['type'];
                $dataTemp['dataid'] = $value['dataid'];
                $dataTemp['userFullName'] = $userList[$dataTemp['dataid']]['fullname'];
                $dataTemp['userRoomNo'] = $userList[$dataTemp['dataid']]['room_no'];
                $dataTemp['cn_title'] = $value['cn_title'];
                $dataTemp['en_title'] = $value['en_title'];
                $dataTemp['url'] = $value['content_value'];
                $dataTemp['result'] = $value['result'];
                $dataTemp['resultShow'] = $value['result'] ? Enum_Lang::getPageText('app', 'resultFail') : Enum_Lang::getPageText('app', 'resultSuccess');
                $dataTemp['platform'] = $value['platform'];
                $dataTemp['platformShow'] = $platformList[$dataTemp['platform']];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * 物业推送列表
     */
    public function pushListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $baseModel = new BaseModel();
            $platformList = $baseModel->getPlatformList();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['type'] = $value['type'];
                $dataTemp['dataid'] = $value['dataid'];
                $dataTemp['cn_title'] = $value['cn_title'];
                $dataTemp['en_title'] = $value['en_title'];
                $dataTemp['url'] = $value['content_value'];
                $dataTemp['result'] = $value['result'];
                $dataTemp['resultShow'] = $value['result'] ? Enum_Lang::getPageText('app', 'resultFail') : Enum_Lang::getPageText('app', 'resultSuccess');
                $dataTemp['platform'] = $value['platform'];
                $dataTemp['platformShow'] = $platformList[$dataTemp['platform']];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * 快捷启动列表
     */
    public function shortcutListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $baseModel = new BaseModel();
            $platformList = $baseModel->getPlatformList();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['key'] = $value['key'];
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['sort'] = $value['sort'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            //            $data['data']['pageData']['page'] = intval($result['page']);
            //            $data['data']['pageData']['rowNum'] = intval($result['total']);
            //            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * 分享平台列表
     */
    public function shareListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $enableTmp = array();
            $disableTmp = array();
            $enableShare = array_column($result['list'], 'key');
            $shareName = Enum_App::getShareNameKeyList();
            foreach ($shareName as $shareKey) {
                $shareInfo = array('key' => $shareKey, 'title' => Enum_Lang::getPageText('share', $shareKey));
                in_array($shareKey, $enableShare) ? $enableTmp[] = $shareInfo : $disableTmp[] = $shareInfo;
            }
            $data['data'] = array(
                'enable' => $enableTmp,
                'disable' => $disableTmp,
            );
        }
        return $data;
    }

    public function rssListConvertor($list, $selectRss) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        $selectRssIdList = array_column($selectRss['data']['list'], 'id');
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                if (in_array($value['id'], $selectRssIdList)) {
                    continue;
                }
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['name'] = Enum_Lang::getSystemLang() == Enum_Lang::LANG_KEY_CHINESE ? $value['name_zh'] : $value['name_en'];
                $dataTemp['rss'] = $value['rss'];
                $dataTemp['typename'] = Enum_Lang::getSystemLang() == Enum_Lang::LANG_KEY_CHINESE ? $value['typename'] : $value['typeenname'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }
}

?>