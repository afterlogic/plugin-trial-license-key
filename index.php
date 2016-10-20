<?php

class_exists('CApi') or die();

class CTrialLicenseKeyPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('before-validate-license-key', 'BeforeValidateLicenseKey');
	}

	public function Init()
	{
		parent::Init();
	}

	/**
	 * @param CAccount $oAccount
	 */
	public function BeforeValidateLicenseKey()
	{
		$oLicensingApi = CApi::Manager('licensing');
		if ($oLicensingApi && 0 === strlen($oLicensingApi->GetLicenseKey()))
		{
			$oLicensingApi->UpdateLicenseKey($oLicensingApi->GetT());
		}
	}
}

return new CTrialLicenseKeyPlugin($this);
