<?php

// An template to use Webdriver

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\{
    RemoteWebDriver, WebDriverCapabilityType
};

//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once('vendor/autoload.php');

class SeleniumPrac extends \PHPUnit_Framework_TestCase
{


    protected $webDriver;
    protected $url = 'http://xxxxxxxxxx.com/';


    public function setUp()
    {
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }


    public function tearDown()
    {
        $this->webDriver->quit();
    }


    public function testGoToHybridAndLogin()
    {
        $this->webDriver->get($this->url);
        $this->assertContains('Login', $this->webDriver->getTitle());
        $this->typeLogin();
    }

    public function typeLogin()
    {
        $this->webDriver->findElement(WebDriverBy::id('username'))->sendKeys('xxxxxxxx');
        $this->webDriver->findElement(WebDriverBy::id('password'))->sendKeys('xxxxxxxx');
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/table[2]/tbody/tr/td/div/div/div/form/button'))->click();
        $this->goToApp();
    }

    public function goToApp()
    {
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[5]/td/input')));
        $this->webDriver->findElement(WebDriverBy::name('view_agent_id'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[2]/td/table/tbody/tr/td[1]/select/option[2]'))->
        click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[5]/td/input'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('agent_id')));
        $this->webDriver->findElement(WebDriverBy::name('agent_id'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[3]/td/form/select/option[2]')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[3]/td/form/select/option[2]'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[3]/td/form/input[4]')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[3]/td/form/input[4]'))->click();
        $this->fillOutBusinessInformationSection();

    }

    public function fillOutBusinessInformationSection()
    {
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::name('dbaName')));
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('stateIncorporation')));
        $this->webDriver->findElement(WebDriverBy::id('stateIncorporation'))->sendKeys('MI');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('grossYearlySales')));
        $this->webDriver->findElement(WebDriverBy::id('grossYearlySales'))->clear();
        $this->webDriver->findElement(WebDriverBy::id('grossYearlySales'))->sendKeys(100000);

        // add Equipment
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[1]/table[6]/tbody/tr/td/b/select/option[2]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('addEquipId')));
        $this->webDriver->findElement(WebDriverBy::id('addEquipId'))->click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/select/optgroup[4]/option[27]'))->
        click();
        // $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/input'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('addEquip')));
        $this->webDriver->findElement(WebDriverBy::name('addEquip'))->click();
        sleep(2);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::xpath('/html/body/div[5]/div[2]/div[3]/div/table/tbody/tr[2]/td/table/tbody/tr/td/center/form/input[4]')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[5]/div[2]/div[3]/div/table/tbody/tr[2]/td/table/tbody/tr/td/center/form/input[4]'))->click();
        sleep(8);
        //Equipment Block
        sleep(3);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[12]/tbody/tr[6]/td/table/tbody/tr[1]/td[1]/label/input')))->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[12]/tbody/tr[6]/td/table/tbody/tr[1]/td[1]/label/input'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::className('formBlock')));
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/table/tbody/tr[7]/td[2]/b/select')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/table/tbody/tr[7]/td[2]/b/select'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('equipment[0][printerId]')));
        $this->webDriver->findElement(WebDriverBy::id('equipment[0][printerId]'))->click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/table/tbody/tr[9]/td[2]/b/select/option[3]'))->click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/table/tbody/tr[7]/td[2]/b/select/option[3]'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('equipment[0][orderType]')));
        $this->webDriver->findElement(WebDriverBy::id('equipment[0][orderType]'))->click();
        $this->webDriver->FindElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[11]/tbody/tr/td/table/tbody/tr[2]/td[5]/b/select/option[2]'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('equipment[0][isp_connection_type]-I')));
        $this->webDriver->findElement(WebDriverBy::id('equipment[0][isp_connection_type]-I'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('marketType')));
        $this->webDriver->findElement(WebDriverBy::id('marketType'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[1]/table[6]/tbody/tr/td/b/select/option[2]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('additionalSave')));
        $this->webDriver->findElement(WebDriverBy::id('additionalSave'))->click();
        sleep(8);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('qualRateEdit')));
        $this->webDriver->findElement(WebDriverBy::id('qualRateEdit'))->sendKeys('1.29');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::name('ratesDdb')));
        $this->webDriver->findElement(WebDriverBy::name('ratesDdb'))->click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[8]/div/table/tbody/tr[1]/td/table/tbody/tr[5]/td[2]/div/select/option[14]'))->click();
        sleep(3);

        //Business Informtion Section
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('businessName')));
        $this->webDriver->findElement(WebDriverBy::name('businessName'))->sendKeys('Test James');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('dbaName')));
        $this->webDriver->findElement(WebDriverBy::name('dbaName'))->sendKeys('James World');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('address')));
        $this->webDriver->findElement(WebDriverBy::id('address'))->sendKeys('1000 Everystreet');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('address2')));
        $this->webDriver->findElement(WebDriverBy::name('address2'))->sendKeys('100');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::name('city')));
        $this->webDriver->findElement(WebDriverBy::name('city'))->sendKeys('Everytown');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('state')));
        $this->webDriver->findElement(WebDriverBy::id('state'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[1]/table[1]/tbody/tr[2]/td[1]/table/tbody/tr[4]/td/table/tbody/tr/td[2]/b/select/option[30]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('zip')));
        $this->webDriver->findElement(WebDriverBy::name('zip'))->sendKeys('48555');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('addressCorp')));
        $this->webDriver->findElement(WebDriverBy::name('addressCorp'))->sendKeys('1001 Everystreet');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('addressCorp2')));
        $this->webDriver->findElement(WebDriverBy::name('addressCorp2'))->sendKeys('101');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cityCorp')));
        $this->webDriver->findElement(WebDriverBy::name('cityCorp'))->sendKeys('Everytown');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('stateCorp')));
        $this->webDriver->findElement(WebDriverBy::id('stateCorp'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[1]/table[1]/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr/td[2]/b/select/option[30]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('zipCorp')));
        $this->webDriver->findElement(WebDriverBy::name('zipCorp'))->sendKeys('48555');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('phoneBus')));
        $this->webDriver->findElement(WebDriverBy::name('phoneBus'))->sendKeys('3133333333');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('fax')));
        $this->webDriver->findElement(WebDriverBy::name('fax'))->sendKeys('5555555555');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('email')));
        $this->webDriver->findElement(WebDriverBy::name('email'))->sendKeys('jamesfake@fake.com');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('website')));
        $this->webDriver->findElement(WebDriverBy::name('website'))->sendKeys('jamesfakefake.com');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('statementOptionType-E')));
        $this->webDriver->findElement(WebDriverBy::id('statementOptionType-E'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('bankName')));
        $this->webDriver->findElement(WebDriverBy::name('bankName'))->sendKeys('ABC Bank');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('bankPhone')));
        $this->webDriver->findElement(WebDriverBy::name('bankPhone'))->sendKeys('5555555556');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('taxId')));
        $this->webDriver->findElement(WebDriverBy::name('taxId'))->sendKeys('123456789');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('tinType-E')));
        $this->webDriver->findElement(WebDriverBy::id('tinType-E'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('checking')));
        $this->webDriver->findElement(WebDriverBy::name('checking'))->sendKeys('987654321');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('routing')));
        $this->webDriver->findElement(WebDriverBy::name('routing'))->sendKeys('072000326');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('contact')));
        $this->webDriver->findElement(WebDriverBy::id('contact'))->sendKeys('James Fake');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('busType-S')));
        $this->webDriver->findElement(WebDriverBy::id('busType-S'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('yearsInBus')));
        $this->webDriver->findElement(WebDriverBy::id('yearsInBus'))->sendKeys('2');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('monthsInBus')));
        $this->webDriver->findElement(WebDriverBy::id('monthsInBus'))->sendKeys('2');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('currentAccept-f')));
        $this->webDriver->findElement(WebDriverBy::id('currentAccept-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('product')));
        $this->webDriver->findElement(WebDriverBy::id('product'))->sendKeys('Computer Services');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('monthlySales')));
        $this->webDriver->findElement(WebDriverBy::id('monthlySales'))->clear();
        $this->webDriver->findElement(WebDriverBy::id('monthlySales'))->sendKeys(10000);
        sleep(1);
        $this->webDriver->switchTo()->alert()->accept();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ticketAve')));
        $this->webDriver->findElement(WebDriverBy::id('ticketAve'))->clear();
        $this->webDriver->findElement(WebDriverBy::id('ticketAve'))->sendKeys(250);
        sleep(1);
        $this->webDriver->switchTo()->alert()->accept();
        sleep(1);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ticketHigh')));
        $this->webDriver->findElement(WebDriverBy::id('ticketHigh'))->clear();
        $this->webDriver->findElement(WebDriverBy::id('ticketHigh'))->sendKeys(999);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('amexApply-t')));
        $this->webDriver->findElement(WebDriverBy::id('amexApply-t'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('perSwipe')));
        $this->webDriver->findElement(WebDriverBy::id('perSwipe'))->sendKeys('100');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('salesStore')));
        $this->webDriver->findElement(WebDriverBy::id('salesStore'))->sendKeys('100');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('marketType')));
        $this->fillOutOwnersSection();
    }

    // Owners or Officers Section
    public function fillOutOwnersSection()
    {

        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownName')));
        $this->webDriver->findElement(WebDriverBy::id('ownName'))->sendKeys('James Fake');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownTitle')));
        $this->webDriver->findElement(WebDriverBy::id('ownTitle'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[3]/table[1]/tbody/tr[1]/td[2]/b/select/option[2]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownAddress')));
        $this->webDriver->findElement(WebDriverBy::id('ownAddress'))->sendKeys('1111 Everystreet');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownAddress2')));
        $this->webDriver->findElement(WebDriverBy::id('ownAddress2'))->sendKeys('1');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownCity')));
        $this->webDriver->findElement(WebDriverBy::id('ownCity'))->sendKeys('Anytown');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownState')));
        $this->webDriver->findElement(WebDriverBy::id('ownState'))->findElement
        (WebDriverBy::xpath('//html/body/div[3]/table/tbody/tr/td/form/div[3]/table[1]/tbody/tr[1]/td[4]/table/tbody/tr/td[2]/b/select/option[30]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownZip')));
        $this->webDriver->findElement(WebDriverBy::id('ownZip'))->sendKeys('48555');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownSsn')));
        $this->webDriver->findElement(WebDriverBy::id('ownSsn'))->sendKeys('123456789');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownPhone')));
        $this->webDriver->findElement(WebDriverBy::id('ownPhone'))->sendKeys('3135557777');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownPer')));
        $this->webDriver->findElement(WebDriverBy::id('ownPer'))->sendKeys('100');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownYrsAddr')));
        $this->webDriver->findElement(WebDriverBy::id('ownYrsAddr'))->sendKeys('10');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownMoAddr')));
        $this->webDriver->findElement(WebDriverBy::id('ownMoAddr'))->sendKeys('1');
        $this->fillOutCardholderSection();
    }

    //Cardholder Data Storage Compliance
    public function fillOutCardholderSection()
    {
        sleep(1);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_data_compromise-f')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_data_compromise-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_pci_dss_certified-f')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_pci_dss_certified-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_dial_up_terminal-f')));
//        $this->webDriver->findElement(WebDriverBy::id('cdsc_dial_up_terminal-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('is_cardholder_data_stored-f')));
        $this->webDriver->findElement(WebDriverBy::id('is_cardholder_data_stored-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_third_party_software_company')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_third_party_software_company'))->sendKeys('Gateway');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_third_party_software_name')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_third_party_software_name'))->sendKeys('ABC LLC');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_third_party_software_version')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_third_party_software_version'))->sendKeys('1.5');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('cdsc_third_party_process-f')));
        $this->webDriver->findElement(WebDriverBy::id('cdsc_third_party_process-f'))->click();
        $this->fillOutBusinessTradeSection();
    }
    // Mail/Phone/Telephone/Internet Section
    // Will complete later
    // Business Trade Suppliers
    public function fillOutBusinessTradeSection()
    {
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyName')));
        $this->webDriver->findElement(WebDriverBy::id('supplyName'))->sendKeys('Fake Inc');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyAddress')));
        $this->webDriver->findElement(WebDriverBy::id('supplyAddress'))->sendKeys('1234 Anystreet');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyContact')));
        $this->webDriver->findElement(WebDriverBy::id('supplyContact'))->sendKeys('Jane Doe');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyPhone')));
        $this->webDriver->findElement(WebDriverBy::id('supplyPhone'))->sendKeys('5555556666');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyName2')));
        $this->webDriver->findElement(WebDriverBy::id('supplyName2'))->sendKeys('Fake LLC');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyAddress2')));
        $this->webDriver->findElement(WebDriverBy::id('supplyAddress2'))->sendKeys('4321 Anystreet');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyContact2')));
        $this->webDriver->findElement(WebDriverBy::id('supplyContact2'))->sendKeys('Jack Doe');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('supplyPhone2')));
        $this->webDriver->findElement(WebDriverBy::id('supplyPhone2'))->sendKeys('5556667777');
        $this->fillOutMerchantSiteSection();
    }

    // Merchant Site Survey Report Section
    public function fillOutMerchantSiteSection()
    {
        sleep(1);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('merchantLocation-S')));
        $this->webDriver->findElement(WebDriverBy::id('merchantLocation-S'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('ownLease-O')));
        $this->webDriver->findElement(WebDriverBy::id('ownLease-O'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('landlordName')));
        $this->webDriver->findElement(WebDriverBy::id('landlordName'))->sendKeys('James Fake');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('landlordPhone')));
        $this->webDriver->findElement(WebDriverBy::id('landlordPhone'))->sendKeys('5555556666');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('surveyVerifiedBy')));
        $this->webDriver->findElement(WebDriverBy::id('surveyVerifiedBy'))->sendKeys('nabprod');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('surveyDate')));
        $this->webDriver->findElement(WebDriverBy::id('surveyDate'))->sendKeys('09/23/2016');
        $this->fillOutMiscSection();
    }

    // Misc Section
    public function fillOutMiscSection()
    {
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('sic')));
        $this->webDriver->findElement(WebDriverBy::id('sic'))->sendKeys('7372');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('bankAccountType-C')));
        $this->webDriver->findElement(WebDriverBy::id('bankAccountType-C'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('bankAccountName')));
        $this->webDriver->findElement(WebDriverBy::id('bankAccountName'))->sendKeys('James World');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('bankCity')));
        $this->webDriver->findElement(WebDriverBy::id('bankCity'))->sendKeys('Troy');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('bankState')));
        $this->webDriver->findElement(WebDriverBy::id('bankState'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[9]/table/tbody/tr[3]/td/table/tbody/tr[2]/td[3]/b/select/option[30]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('shipTo-dba')));
        $this->webDriver->findElement(WebDriverBy::id('shipTo-dba'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('shipMethod-2ndday')));
        $this->webDriver->findElement(WebDriverBy::id('shipMethod-2ndday'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('statusType-P')));
        $this->webDriver->findElement(WebDriverBy::id('statusType-P'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('purchaseAmount')));
        $this->webDriver->findElement(WebDriverBy::id('purchaseAmount'))->sendKeys('100');
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('payment_agent-A')));
        $this->webDriver->findElement(WebDriverBy::id('payment_agent-A'))->click();
        //$this->webDriver->findElement(WebDriverBy::id('giftcard_enable-t'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('checkType')));
        $this->webDriver->findElement(WebDriverBy::id('checkType'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[9]/table/tbody/tr[7]/td/table/tbody/tr/td[2]/table/tbody/tr[4]/td[2]/select/option[2]'))->
        click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('globalcheck_stop_payment-f')));
        $this->webDriver->findElement(WebDriverBy::id('globalcheck_stop_payment-f'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('reprogram-V')));
        $this->webDriver->findElement(WebDriverBy::id('reprogram-V'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('train-N')));
        $this->webDriver->findElement(WebDriverBy::id('train-N'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('additionalFormValidator')));
        $this->webDriver->findElement(WebDriverBy::id('additionalFormValidator'))->click();
        sleep(8);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('additionalSave')));
        $this->webDriver->findElement(WebDriverBy::id('additionalSave'))->click();
        sleep(5);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[12]/tbody/tr[6]/td/table/tbody/tr[1]/td[1]/label/input')))->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[12]/tbody/tr[6]/td/table/tbody/tr[1]/td[1]/label/input'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(
            WebDriverBy::id('marketType')));
        $this->webDriver->findElement(WebDriverBy::id('marketType'))->findElement
        (WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[1]/table[6]/tbody/tr/td/b/select/option[2]'))->
        click();
        sleep(1);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('additionalFormValidator')));
        $this->webDriver->findElement(WebDriverBy::id('additionalFormValidator'))->click();
        sleep(8);

        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::name('ratesDdb')));
        $this->webDriver->findElement(WebDriverBy::name('ratesDdb'))->click();
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/div[8]/div/table/tbody/tr[1]/td/table/tbody/tr[5]/td[2]/div/select/option[14]'))->click();
        sleep(1);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('additionalFormValidator')));
        $this->webDriver->findElement(WebDriverBy::id('additionalFormValidator'))->click();
        sleep(8);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('additionalSave')));
        $this->webDriver->findElement(WebDriverBy::id('additionalSave'))->click();
        sleep(5);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[1]/tbody/tr/td[1]/table/tbody/tr/td/input')))
            ->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[1]/tbody/tr/td[1]/table/tbody/tr/td/input'))->click();
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[1]/tbody/tr/td[1]/table/tbody/tr/td/input')))
            ->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr/td/form/table[1]/tbody/tr/td[1]/table/tbody/tr/td/input'))->click();
        ///html/body/div[3]/table/tbody/tr/td/form/table[1]/tbody/tr/td[1]/table/tbody/tr/td/input
        //html body div#contentBlock table tbody tr td form.form-inline table tbody tr td table.status tbody tr td.go.alert.alert-success input.btn.btn-default
        sleep(10);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('change_program')));
        $this->webDriver->findElement(WebDriverBy::id('change_program'))->click();
        sleep(5);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/table[3]/tbody/tr/td[1]/div/input')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table[3]/tbody/tr/td[1]/div/input'))->click();
        sleep(8);
        $this->webDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::xpath('/html/body/div[3]/form/table/tbody/tr/td[1]/table/tbody/tr/td/div/input[3]')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/form/table/tbody/tr/td[1]/table/tbody/tr/td/div/input[3]'))->click();
        sleep(10);

    }
}
