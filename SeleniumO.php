<?php

// An example of using php-webdriver.

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\{
    RemoteWebDriver, WebDriverCapabilityType
};

require_once "PHPUnit/Extensions/SeleniumTestCase.php";
require_once('vendor/autoload.php');

class SeleniumPrac extends \PHPUnit_Extensions_Selenium2TestCase
{


    protected $webDriver;
    protected $url = 'http://stage5.elap.nabstage01.northamericanbancard.com/';


    public function setUp()
    {
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
        $this->setBrowserUrl('xxxxxxxx');
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
        //$form = $this->webDriver->findElement(WebDriverBy::className('form-group'));
        $this->webDriver->findElement(WebDriverBy::id('username'))->sendKeys('xxxxxxxx');
        $this->webDriver->findElement(WebDriverBy::id('password'))->sendKeys('xxxxxxxx');
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/table[2]/tbody/tr/td/div/div/div/form/button'))->click();
        $this->webDriver->wait(100)->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[5]/td/input')));
        $this->webDriver->findElement(WebDriverBy::xpath('/html/body/div[3]/table/tbody/tr[3]/td/form/select/option[2]'))->click();
        $this->goToApp();
    }
    public function goToApp()
    {

        $this->webDriver->findElement(WebDriverBy::name(""))->click();
        //$form->submit();
        $this-> fillOutApp();
    }
    public function fillOutApp()
    {
        $this->webDriver->wait(100)->until(WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
            WebDriverBy::id('businessName')));
        $this->webDriver->findElement(WebDriverBy::id('businessName'))->sendKeys('James World');
    }
}