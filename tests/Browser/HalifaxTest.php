<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class HalifaxTest extends DuskTestCase
{
    /** @test */
    public function login()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('https://www.halifax-online.co.uk/personal/logon/login.jsp')
                ->waitFor('.tealium_confirm')
                ->click('.tealium_confirm')
                ->type('frmLogin:strCustomerLogin_userID', config('banking.halifax.username'))
                ->type('frmLogin:strCustomerLogin_pwd', config('banking.halifax.password'))
                ->press('frmLogin:btnLogin1')
                ->waitFor('.memInfoSelect');

            preg_match("/Please enter characters (\d), (\d) and (\d)/", $browser->text('.inner'), $challengeCharacters);

            // Pad 0th index, otherwise we'd need to remove one from each quoted challenge character
            $memorableInformation = '0' . strtolower(config('banking.halifax.memorable-information'));

            $browser
                ->select('frmentermemorableinformation1:strEnterMemorableInformation_memInfo1', '&nbsp;' . $memorableInformation[$challengeCharacters[1]])
                ->select('frmentermemorableinformation1:strEnterMemorableInformation_memInfo2', '&nbsp;' . $memorableInformation[$challengeCharacters[2]])
                ->select('frmentermemorableinformation1:strEnterMemorableInformation_memInfo3', '&nbsp;' . $memorableInformation[$challengeCharacters[3]])
                ->click('#frmentermemorableinformation1:btnContinue');

            $browser->assertSee('Sign out');
            $browser->screenshot('HomePage');

            return $browser;
        });
    }
}
