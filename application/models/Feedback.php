<?php

/**
 * 调查问卷Model
 */
class FeedbackModel extends \BaseModel {

    /**
     * 获取表单列表
     */
    public function getList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['name'] ? $params['name'] = $paramList['name'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $paramList['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('F005', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建编辑表单信息
     */
    public function saveListDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;

            $checkParams = Enum_Feedback::getFeedbackListMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }

            $interfaceId = $params['id'] ? 'F007' : 'F006';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取问题列表
     */
    public function getQuestionList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['question'] ? $params['question'] = $paramList['question'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['listid'] ? $params['listid'] = $paramList['listid'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('F001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建编辑问题信息
     */
    public function saveQuestionDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['question'] ? $params['question'] = $paramList['question'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['listid'] ? $params['listid'] = $paramList['listid'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;

            $checkParams = Enum_Feedback::getFeedbackMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }

            $interfaceId = $params['id'] ? 'F003' : 'F002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 保存问题选项
     */
    public function saveQuestionOptionInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['option'] ? $params['option'] = $paramList['option'] : false;

            if (empty($params['id'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('F003', $params);
        } while (false);
        return $result;
    }

    /**
     * 获取调查反馈列表
     */
    public function getResultList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('F004', $params);
        } while (false);
        return (array)$result;
    }
}
