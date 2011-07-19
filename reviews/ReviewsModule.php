<?php
Yii::import("blocks.moderator.ModeratorModule",true);
Yii::import("blocks.ratings.RatingsModule",true);
Yii::import("blocks.voting.VotingModule",true);
Yii::import("blocks.reviews.models.*");
Yii::import("blocks.reviews.interfaces.*");
Yii::import("blocks.reviews.components.*");
/**
 * Holds functionality relating to user supplied reviews.
 * Reviews can be attached to other models and are managed via the review controller.
 * @package blocks.reviews
 * @author Charles Pick
 */
class ReviewsModule extends CWebModule {
	
	/**
	 * The name of the reviews table
	 * Defaults to "reviews"
	 * @type string 
	 */
	public $reviewTable = "reviews";
	
	/**
	 * Whether users must be logged in or not to review, defaults to true.
	 * @var boolean
	 */
	public $requiresLogin = true;
	
	/**
	 * Whether reviews should be moderated before they go live.
	 * Defaults to true.
	 * @var boolean
	 */
	public $moderateReviews = true;
	
	/**
	 * The URL users should be redirected to after submitting a review.
	 * Defaults to array("/site/index").
	 * @var mixed
	 */
	public $returnUrl = array("/site/index");
	/**
	 * Holds an array of items to show in the main menu
	 */
	public $mainMenu = array(
			array('label'=>'Home', 'url'=>array('/reviews/review/admin'))
		);
		
	/**
	 * Called when the module is being created.
	 * Put any module specific configuration here
	 */
	public function init()
	{
		return parent::init();
	}
	
}
