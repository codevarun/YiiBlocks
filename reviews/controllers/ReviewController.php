<?php
/**
 * Deals with creating, reading, updating and deleting reviews.
 * @author Charles Pick
 * @package blocks.reviews.controllers
 */
class ReviewController extends CController {
	
	/**
	 * Creates a review owned by the given model.
	 * @param string $ownerModel The class name of the owner model that owns this review
	 * @param integer $ownerId The ID of the model that owns this review
	 */
	public function actionCreate($ownerModel, $ownerId) {
		$owner = $ownerModel::model()->findByPk($ownerId);
		if (!is_object($owner) || (!($owner instanceof IAReviewable) && !is_object($owner->asa("reviewable")))) {
			throw new CHttpException(500,Yii::t("blocks","Invalid Request"));
		}
		
		$model = new AReview();
		$this->performAjaxValidation($model);
		if (isset($_POST['AReview'])) {
			$model->attributes = $_POST['AReview'];
			if ($model->save()) {
				Yii::app()->user->setFlash("success",Yii::t("blocks.reviews","<h3>Thanks, your review was added</h3><p>Your review was added, thanks for your contribution</p>"));
				if (($owner instanceof IALinkable) || is_object($owner->asa("linkable"))) {
					$this->redirect($owner->createUrl());
				}
				else {
					$this->redirect(Yii::app()->getModule("reviews")->returnUrl);
				}
			}
		}
		
		
		if (Yii::app()->request->isAjaxRequest) {
			echo $this->renderPartial("_create",array("model" => $model, "owner" => $owner),true, true);
		}
		else {
			$this->render("create",array("model" => $model, "owner" => $owner));
		}
		
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='review-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
