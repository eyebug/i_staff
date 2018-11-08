<?php

/**
 * 活动管理控制器
 */
class ActivityController extends \BaseController {

    /**
     * 活动标签
     */
    public function tagAction() {
        $this->_view->display('activity/tag.phtml');
    }

    /**
     * 活动列表
     */
    public function listAction() {
        $activityModel = new ActivityModel();
        $tagList = $activityModel->getTagList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('activity/activity.phtml');
    }

    /**
     * 活动参与订单列表
     */
    public function orderAction() {
        $activityModel = new ActivityModel();
        $activityList = $activityModel->getActivityList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('activityList', $activityList['data']['list']);
        $this->_view->display('activity/order.phtml');
    }

    /**
     * 导出为Excel
     */
    public function exportAction() {
        $paramList['id'] = intval($this->getGet('id'));
        $paramList['name'] = trim($this->getGet('title'));
        $paramList['phone'] = trim($this->getGet('phone'));
        $paramList['activityid'] = intval($this->getGet('activityid'));
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['groupid'] = intval($this->getGroupId());
        $paramList['limit'] = 0;
        $activityModel = new ActivityModel();
        $activityConvertor = new Convertor_Activity();
        $result = $activityModel->getOrderList($paramList);
        $result = $activityConvertor->orderListConvertor($result);
        $headList = array('ID', '用户ID', '用户名', '姓名', '联系电话', '创建时间', '物业ID', '物业名称', '活动ID', '活动名称', '报名人数', '备注');
        $fileName = 'hotelActivityOrderUserList';
        $fileNameParams = array();
        $paramList['id'] && $fileNameParams[] = "ID:" . $paramList['id'];
        $paramList['name'] && $fileNameParams[] = "姓名:" . $paramList['name'];
        $paramList['phone'] && $fileNameParams[] = "联系电话:" . $paramList['phone'];
        $paramList['activityid'] && $fileNameParams[] = "活动ID:" . $paramList['activityid'];
        $fileName = $fileNameParams ? $fileName . '_' . implode("+", $fileNameParams) : $fileName;
        Util_Tools::csv_export($result['data']['list'], $headList, $fileName);
    }
}
