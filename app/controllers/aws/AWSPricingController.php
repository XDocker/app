<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getIndex()
 * Classes list:
 * - AWSController extends BaseController
 */
class AWSPricingController extends BaseController {
   
    /**
     * User Model
     * @var User
     */
    protected $user;
    /**
     * Inject the models.
     * @param Account $account
     * @param User $user
     */
    public function __construct(User $user) {
        parent::__construct();
       $this->user = $user;
    }
    /**
     * Returns all the Accounts for logged in user.
     *
     * @return View
     */
    public function getIndex() {
        $ec2 = new EC2InstancePrices();
		//$ec2->get_ec2_ondemand_instances_prices('us-east-1', 'm1.small', 'linux')
        return View::make('site/aws/index', array(
            'ec2Data' => $ec2->getEc2Data()
        ));
    }

	
	
}
