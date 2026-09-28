<?php

namespace App;

use Framework\Auth\DummyAuthenticator;
use Framework\Core\ErrorHandler;
use Framework\DB\SnakeConventions;

/**
 * AI-assisted migration from the previous Laravel configuration to Vaííčko 3.0.6.
 */
class Configuration
{
    public const APP_NAME = 'RealEstate';
    public const FW_VERSION = '3.0.6';

    public const DB_HOST = 'db';
    public const DB_NAME = 'realestate';
    public const DB_USER = 'realestate_user';
    public const DB_PASS = 'realestate_pass';

    public const LOGIN_URL = '?c=auth&a=login';
    public const ROOT_LAYOUT = 'root';
    public const SHOW_SQL_QUERY = false;
    public const DB_CONVENTIONS_CLASS = SnakeConventions::class;
    public const SHOW_EXCEPTION_DETAILS = true;
    public const AUTH_CLASS = DummyAuthenticator::class;
    public const ERROR_HANDLER_CLASS = ErrorHandler::class;

    public const UPLOAD_DIR = 'uploads' . DIRECTORY_SEPARATOR;
    public const UPLOAD_URL = '/uploads/';
    public const IDENTITY_SESSION_KEY = 'fw.session.user.identity';
}
