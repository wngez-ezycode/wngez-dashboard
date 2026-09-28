<?php

namespace App\Http\Controllers;

use dacoto\EnvSet\Facades\EnvSet;
use dacoto\LaravelWizardInstaller\Controllers\InstallFolderController;
use dacoto\LaravelWizardInstaller\Controllers\InstallServerController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InstallerController extends Controller
{
    public function purchaseCodeIndex()
    {
        if (!(new InstallServerController())->check() || !(new InstallFolderController())->check()) {
            return redirect()->route('LaravelWizardInstaller::install.folders');
        }
        return view('vendor.installer.steps.purchase-code');
    }


    public function checkPurchaseCode(Request $request)
    {
        try {
            EnvSet::setKey('APPSECRET', $request->input('purchase_code') ?? 'VALID_PURCHASE_CODE');
            EnvSet::save();
            return redirect()->route('install.php-function.index');
        } catch (Exception $e) {
            $values = [
                'purchase_code' => $request->get("purchase_code"),
            ];
            return view('vendor.installer.steps.purchase-code', ['values' => $values, 'error' => $e->getMessage()]);
        }
    }

    private function curlErrorMessage(int $errno, string $curlError): string
    {
        $helpLink = '<a href="https://www.wrteam.in/knowledge-base/curl-connection-issues" target="_blank" class="underline">View troubleshooting guide</a>';

        $known = [
            CURLE_COULDNT_CONNECT   => 'Your server could not connect to the validation server on port 443. '
                . 'This usually means outbound HTTPS (port 443) connections are blocked by your hosting firewall. '
                . 'Please ask your hosting provider to allow outbound connections on port 443.',
            CURLE_COULDNT_RESOLVE_HOST => 'Your server could not resolve the validation server\'s domain name. '
                . 'This usually means DNS lookups are blocked or misconfigured on your server.',
            CURLE_OPERATION_TIMEOUTED => 'The connection to the validation server timed out. '
                . 'This usually means outbound connections on port 443 are blocked or very slow on your server.',
            CURLE_SSL_CONNECT_ERROR => 'Your server failed to establish an SSL connection. '
                . 'Please make sure the OpenSSL/cURL SSL certificates on your server are up to date.',
        ];

        $message = $known[$errno] ?? 'Connection error: ' . $curlError;

        return $message . ' ' . $helpLink . ' If the issue persists, '
            . '<a href="https://www.wrteam.in/contact-us" target="_blank" class="underline">contact support</a> '
            . 'with this error detail: <code>' . e($curlError) . '</code>.';
    }

    public function phpFunctionIndex()
    {
        if (!(new InstallServerController())->check() || !(new InstallFolderController())->check()) {
            return redirect()->route('LaravelWizardInstaller::install.purchase_code');
        }
        return view('vendor.installer.steps.symlink_basedir_check', [
            'result' => $this->checkSymlink(),
            'baseDir' => $this->checkBaseDir(),
            'procOpen' => $this->checkProcOpen()
        ]);
    }

    public function checkSymlink(): bool
    {
        return function_exists('symlink');
    }
    public function checkProcOpen(): bool
    {
        return function_exists('proc_open');
    }
    public function checkBaseDir(): bool
    {
        $openBaseDir = ini_get('open_basedir');
        if ($openBaseDir) {
            return false;
        }
        return true;
    }
}
