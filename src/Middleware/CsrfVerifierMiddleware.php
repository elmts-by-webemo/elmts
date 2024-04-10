<?php

namespace Elmts\Core\Middleware;

use \Pecee\Http\Middleware\BaseCsrfVerifier;

class CsrfVerifierMiddleware extends BaseCsrfVerifier
{
	/**
	 * CSRF validation will be ignored on the following urls.
	 */
	protected array $except  = ['/api/*'];

}