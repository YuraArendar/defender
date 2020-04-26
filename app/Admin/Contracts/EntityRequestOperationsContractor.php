<?php

namespace App\Admin\Contracts;

use Closure;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface EntityRequestOperationsContractor
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData();

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated();

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages();

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes();

    /**
     * Set the Validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return $this
     */
    public function setValidator(Validator $validator);

    /**
     * Set the Redirector instance.
     *
     * @param \Illuminate\Routing\Redirector $redirector
     * @return $this
     */
    public function setRedirector(Redirector $redirector);

    /**
     * Set the container implementation.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     * @return $this
     */
    public function setContainer(Container $container);

    /**
     * Determine if the given content types match.
     *
     * @param string $actual
     * @param string $type
     * @return bool
     */
    public static function matchesType($actual, $type);

    /**
     * Determine if the request is sending JSON.
     *
     * @return bool
     */
    public function isJson();

    /**
     * Determine if the current request probably expects a JSON response.
     *
     * @return bool
     */
    public function expectsJson();

    /**
     * Determine if the current request is asking for JSON.
     *
     * @return bool
     */
    public function wantsJson();

    /**
     * Determines whether the current requests accepts a given content type.
     *
     * @param string|array $contentTypes
     * @return bool
     */
    public function accepts($contentTypes);

    /**
     * Return the most suitable content type from the given array based on content negotiation.
     *
     * @param string|array $contentTypes
     * @return string|null
     */
    public function prefers($contentTypes);

    /**
     * Determine if the current request accepts any content type.
     *
     * @return bool
     */
    public function acceptsAnyContentType();

    /**
     * Determines whether a request accepts JSON.
     *
     * @return bool
     */
    public function acceptsJson();

    /**
     * Determines whether a request accepts HTML.
     *
     * @return bool
     */
    public function acceptsHtml();

    /**
     * Get the data format expected in the response.
     *
     * @param string $default
     * @return string
     */
    public function format($default = 'html');

    /**
     * Retrieve an old input item.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array
     */
    public function old($key = null, $default = null);

    /**
     * Flash the input for the current request to the session.
     *
     * @return void
     */
    public function flash();

    /**
     * Flash only some of the input to the session.
     *
     * @param array|mixed $keys
     * @return void
     */
    public function flashOnly($keys);

    /**
     * Flash only some of the input to the session.
     *
     * @param array|mixed $keys
     * @return void
     */
    public function flashExcept($keys);

    /**
     * Flush all of the old input from the session.
     *
     * @return void
     */
    public function flush();

    /**
     * Retrieve a server variable from the request.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array|null
     */
    public function server($key = null, $default = null);

    /**
     * Determine if a header is set on the request.
     *
     * @param string $key
     * @return bool
     */
    public function hasHeader($key);

    /**
     * Retrieve a header from the request.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array|null
     */
    public function header($key = null, $default = null);

    /**
     * Get the bearer token from the request headers.
     *
     * @return string|null
     */
    public function bearerToken();

    /**
     * Determine if the request contains a given input item key.
     *
     * @param string|array $key
     * @return bool
     */
    public function exists($key);

    /**
     * Determine if the request contains a given input item key.
     *
     * @param string|array $key
     * @return bool
     */
    public function has($key);

    /**
     * Determine if the request contains any of the given inputs.
     *
     * @param string|array $keys
     * @return bool
     */
    public function hasAny($keys);

    /**
     * Determine if the request contains a non-empty value for an input item.
     *
     * @param string|array $key
     * @return bool
     */
    public function filled($key);

    /**
     * Determine if the request contains a non-empty value for any of the given inputs.
     *
     * @param string|array $keys
     * @return bool
     */
    public function anyFilled($keys);

    /**
     * Determine if the request is missing a given input item key.
     *
     * @param string|array $key
     * @return bool
     */
    public function missing($key);

    /**
     * Get the keys for all of the input and files.
     *
     * @return array
     */
    public function keys();

    /**
     * Get all of the input and files for the request.
     *
     * @param array|mixed|null $keys
     * @return array
     */
    public function all($keys = null);

    /**
     * Retrieve an input item from the request.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function input($key = null, $default = null);

    /**
     * Retrieve input as a boolean value.
     *
     * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
     *
     * @param string|null $key
     * @param bool $default
     * @return bool
     */
    public function boolean($key = null, $default = false);

    /**
     * Get a subset containing the provided keys with values from the input data.
     *
     * @param array|mixed $keys
     * @return array
     */
    public function only($keys);

    /**
     * Get all of the input except for a specified array of items.
     *
     * @param array|mixed $keys
     * @return array
     */
    public function except($keys);

    /**
     * Retrieve a query string item from the request.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array|null
     */
    public function query($key = null, $default = null);

    /**
     * Retrieve a request payload item from the request.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array|null
     */
    public function post($key = null, $default = null);

    /**
     * Determine if a cookie is set on the request.
     *
     * @param string $key
     * @return bool
     */
    public function hasCookie($key);

    /**
     * Retrieve a cookie from the request.
     *
     * @param string|null $key
     * @param string|array|null $default
     * @return string|array|null
     */
    public function cookie($key = null, $default = null);

    /**
     * Get an array of all of the files on the request.
     *
     * @return array
     */
    public function allFiles();

    /**
     * Determine if the uploaded data contains a file.
     *
     * @param string $key
     * @return bool
     */
    public function hasFile($key);

    /**
     * Retrieve a file from the request.
     *
     * @param string|null $key
     * @param mixed $default
     * @return \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array|null
     */
    public function file($key = null, $default = null);

    /**
     * Register a custom macro.
     *
     * @param string $name
     * @param object|callable $macro
     * @return void
     */
    public static function macro($name, $macro);

    /**
     * Mix another object into the class.
     *
     * @param object $mixin
     * @param bool $replace
     * @return void
     *
     * @throws \ReflectionException
     */
    public static function mixin($mixin, $replace = true);

    /**
     * Checks if macro is registered.
     *
     * @param string $name
     * @return bool
     */
    public static function hasMacro($name);

    /**
     * Checks whether support for the _method request parameter is enabled.
     *
     * @return bool True when the _method request parameter is enabled, false otherwise
     */
    public static function getHttpMethodParameterOverride();

    /**
     * Returns the password.
     *
     * @return string|null
     */
    public function getPassword();

    /**
     * Returns the path as relative reference from the current Request path.
     *
     * Only the URIs path component (no schema, host etc.) is relevant and must be given.
     * Both paths must be absolute and not contain relative parts.
     * Relative URLs from one resource to another are useful when generating self-contained downloadable document archives.
     * Furthermore, they can be used to reduce the link size in documents.
     *
     * Example target paths, given a base path of "/a/b/c/d":
     * - "/a/b/c/d"     -> ""
     * - "/a/b/c/"      -> "./"
     * - "/a/b/"        -> "../"
     * - "/a/b/c/other" -> "other"
     * - "/a/x/y"       -> "../../x/y"
     *
     * @return string The relative target path
     */
    public function getRelativeUriForPath(string $path);

    /**
     * Gets a list of languages acceptable by the client browser.
     *
     * @return array Languages ordered in the user browser preferences
     */
    public function getLanguages();

    /**
     * Return the Request instance.
     *
     * @return $this
     */
    public function instance();

    /**
     * Get the full URL for the request with the added query string parameters.
     *
     * @param array $query
     * @return string
     */
    public function fullUrlWithQuery(array $query);

    /**
     * Get the user making the request.
     *
     * @param string|null $guard
     * @return mixed
     */
    public function user($guard = null);

    /**
     * Get all of the input and files for the request.
     *
     * @return array
     */
    public function toArray();

    /**
     * Returns the requested URI (path and query string).
     *
     * @return string The raw URI (i.e. not URI decoded)
     */
    public function getRequestUri();

    /**
     * Set the session instance on the request.
     *
     * @param \Illuminate\Contracts\Session\Session $session
     * @return void
     */
    public function setLaravelSession($session);

    /**
     * Creates a Request based on a given URI and configuration.
     *
     * The information contained in the URI always take precedence
     * over the other information (server and parameters).
     *
     * @param string $uri The URI
     * @param string $method The HTTP method
     * @param array $parameters The query (GET) or request (POST) parameters
     * @param array $cookies The request cookies ($_COOKIE)
     * @param array $files The request files ($_FILES)
     * @param array $server The server parameters ($_SERVER)
     * @param string|resource|null $content The raw body data
     *
     * @return static
     */
    public static function create(
        string $uri,
        string $method = 'GET',
        array $parameters = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    );

    public function setSession(SessionInterface $session);

    /**
     * Returns the client IP address.
     *
     * This method can read the client IP address from the "X-Forwarded-For" header
     * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
     * header value is a comma+space separated list of IP addresses, the left-most
     * being the original client, and each successive proxy that passed the request
     * adding the IP address where it received the request from.
     *
     * If your reverse proxy uses a different header name than "X-Forwarded-For",
     * ("Client-Ip" for instance), configure it via the $trustedHeaderSet
     * argument of the Request::setTrustedProxies() method instead.
     *
     * @return string|null The client IP address
     *
     * @see getClientIps()
     * @see https://wikipedia.org/wiki/X-Forwarded-For
     */
    public function getClientIp();

    /**
     * Gets the request's scheme.
     *
     * @return string
     */
    public function getScheme();

    /**
     * Returns the user.
     *
     * @return string|null
     */
    public function getUser();

    /**
     * Generates a normalized URI (URL) for the Request.
     *
     * @return string A normalized URI (URL) for the Request
     *
     * @see getQueryString()
     */
    public function getUri();

    /**
     * Checks whether the request is secure or not.
     *
     * This method can read the client protocol from the "X-Forwarded-Proto" header
     * when trusted proxies were set via "setTrustedProxies()".
     *
     * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
     *
     * @return bool
     */
    public function isSecure();

    /**
     * Gets the mime type associated with the format.
     *
     * @return string|null The associated mime type (null if not found)
     */
    public function getMimeType(string $format);

    /**
     * Create a new Illuminate HTTP request from server variables.
     *
     * @return static
     */
    public static function capture();

    /**
     * Determine if the route name matches a given pattern.
     *
     * @param mixed ...$patterns
     * @return bool
     */
    public function routeIs(...$patterns);

    /**
     * Set the value at the given offset.
     *
     * @param string $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value);

    /**
     * Returns the client IP addresses.
     *
     * In the returned array the most trusted IP address is first, and the
     * least trusted one last. The "real" client IP address is the last one,
     * but this is also the least trusted one. Trusted proxies are stripped.
     *
     * Use this method carefully; you should use getClientIp() instead.
     *
     * @return array The client IP addresses
     *
     * @see getClientIp()
     */
    public function getClientIps();

    /**
     * Returns the HTTP host being requested.
     *
     * The port name will be appended to the host if it's non-standard.
     *
     * @return string
     */
    public function getHttpHost();

    /**
     * Gets the "real" request method.
     *
     * @return string The request method
     *
     * @see getMethod()
     */
    public function getRealMethod();

    /**
     * Associates a format with mime types.
     *
     * @param string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
     */
    public function setFormat(?string $format, $mimeTypes);

    /**
     * @return bool
     */
    public function isNoCache();

    /**
     * Returns the preferred language.
     *
     * @param string[] $locales An array of ordered available locales
     *
     * @return string|null The preferred locale
     */
    public function getPreferredLanguage(array $locales = null);

    /**
     * Determine if the request is the result of an PJAX call.
     *
     * @return bool
     */
    public function pjax();

    /**
     * Replace the input for the current request.
     *
     * @param array $input
     * @return $this
     */
    public function replace(array $input);

    /**
     * Sets the request method.
     */
    public function setMethod(string $method);

    /**
     * Gets the mime types associated with the format.
     *
     * @return array The associated mime types
     */
    public static function getMimeTypes(string $format);

    /**
     * Gets the format associated with the request.
     *
     * @return string|null The format (null if no content type is present)
     */
    public function getContentType();

    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Get the URL (no query string) for the request.
     *
     * @return string
     */
    public function url();

    /**
     * Get all of the segments for the request path.
     *
     * @return array
     */
    public function segments();

    /**
     * This method belongs to Symfony HttpFoundation and is not usually needed when using Laravel.
     *
     * Instead, you may use the "input" method.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Set the route resolver callback.
     *
     * @param \Closure $callback
     * @return $this
     */
    public function setRouteResolver(Closure $callback);

    /**
     * Gets the set of trusted headers from trusted proxies.
     *
     * @return int A bit field of Request::HEADER_* that defines which headers are trusted from your proxies
     */
    public static function getTrustedHeaderSet();

    /**
     * Returns the port on which the request is made.
     *
     * This method can read the client port from the "X-Forwarded-Port" header
     * when trusted proxies were set via "setTrustedProxies()".
     *
     * The "X-Forwarded-Port" header must contain the client port.
     *
     * @return int|string can be a string if fetched from the server bag
     */
    public function getPort();

    /**
     * Get the request method.
     *
     * @return string
     */
    public function method();

    /**
     * Determine if the current request URI matches a pattern.
     *
     * @param mixed ...$patterns
     * @return bool
     */
    public function is(...$patterns);

    /**
     * Get the client IP address.
     *
     * @return string|null
     */
    public function ip();

    /**
     * Get a unique fingerprint for the request / route / IP address.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function fingerprint();

    /**
     * Set the user resolver callback.
     *
     * @param \Closure $callback
     * @return $this
     */
    public function setUserResolver(Closure $callback);

    /**
     * Gets the preferred format for the response by inspecting, in the following order:
     *   * the request format set using setRequestFormat
     *   * the values of the Accept HTTP header
     *
     * Note that if you use this method, you should send the "Vary: Accept" header
     * in the response to prevent any issues with intermediary HTTP caches.
     */
    public function getPreferredFormat(?string $default = 'html'): ?string;

    /**
     * Get the route resolver callback.
     *
     * @return \Closure
     */
    public function getRouteResolver();

    /**
     * Remove the value at the given offset.
     *
     * @param string $offset
     * @return void
     */
    public function offsetUnset($offset);

    /**
     * Overrides the PHP global variables according to this request instance.
     *
     * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
     * $_FILES is never overridden, see rfc1867
     */
    public function overrideGlobals();

    /**
     * Sets a list of trusted host patterns.
     *
     * You should only list the hosts you manage using regexs.
     *
     * @param array $hostPatterns A list of trusted host patterns
     */
    public static function setTrustedHosts(array $hostPatterns);

    /**
     * Get the root URL for the application.
     *
     * @return string
     */
    public function root();

    /**
     * Get the full URL for the request.
     *
     * @return string
     */
    public function fullUrl();

    /**
     * Create a new request instance from the given Laravel request.
     *
     * @param \Illuminate\Http\Request $from
     * @param \Illuminate\Http\Request|null $to
     * @return static
     */
    public static function createFrom(Request $from, $to = null);

    /**
     * Normalizes a query string.
     *
     * It builds a normalized query string, where keys/value pairs are alphabetized,
     * have consistent escaping and unneeded delimiters are removed.
     *
     * @return string A normalized query string for the Request
     */
    public static function normalizeQueryString(?string $qs);

    /**
     * Gets a list of content types acceptable by the client browser.
     *
     * @return array List of content types in preferable order
     */
    public function getAcceptableContentTypes();

    /**
     * Determine if the current request URL and query string matches a pattern.
     *
     * @param mixed ...$patterns
     * @return bool
     */
    public function fullUrlIs(...$patterns);

    /**
     * Gets the list of trusted host patterns.
     *
     * @return array An array of trusted host patterns
     */
    public static function getTrustedHosts();

    /**
     * Returns current script name.
     *
     * @return string
     */
    public function getScriptName();

    /**
     * Gets the request "intended" method.
     *
     * If the X-HTTP-Method-Override header is set, and if the method is a POST,
     * then it is used to determine the "real" intended HTTP method.
     *
     * The _method request parameter can also be used to determine the HTTP method,
     * but only if enableHttpMethodParameterOverride() has been called.
     *
     * The method is always an uppercased string.
     *
     * @return string The request method
     *
     * @see getRealMethod()
     */
    public function getMethod();

    /**
     * Gets the format associated with the mime type.
     *
     * @return string|null The format (null if not found)
     */
    public function getFormat(?string $mimeType);

    /**
     * Get a segment from the URI (1 based index).
     *
     * @param int $index
     * @param string|null $default
     * @return string|null
     */
    public function segment($index, $default = null);

    /**
     * Determine if the request is the result of an prefetch call.
     *
     * @return bool
     */
    public function prefetch();

    /**
     * Determine if the request is over HTTPS.
     *
     * @return bool
     */
    public function secure();

    /**
     * Get the JSON payload for the request.
     *
     * @param string|null $key
     * @param mixed $default
     * @return \Symfony\Component\HttpFoundation\ParameterBag|mixed
     */
    public function json($key = null, $default = null);

    /**
     * Create an Illuminate request from a Symfony instance.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return static
     */
    public static function createFromBase(SymfonyRequest $request);

    /**
     * {@inheritdoc}
     */
    public function duplicate(
        array $query = null,
        array $request = null,
        array $attributes = null,
        array $cookies = null,
        array $files = null,
        array $server = null
    );

    /**
     * Get the session associated with the request.
     *
     * @return \Illuminate\Session\Store
     *
     * @throws \RuntimeException
     */
    public function session();

    /**
     * Determine if the given offset exists.
     *
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset);

    /**
     * Sets the parameters for this request.
     *
     * This method also re-initializes all properties.
     *
     * @param array $query The GET parameters
     * @param array $request The POST parameters
     * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
     * @param array $cookies The COOKIE parameters
     * @param array $files The FILES parameters
     * @param array $server The SERVER parameters
     * @param string|resource|null $content The raw body data
     */
    public function initialize(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    );

    /**
     * Creates a new request with values from PHP's super globals.
     *
     * @return static
     */
    public static function createFromGlobals();

    /**
     * Sets a callable able to create a Request instance.
     *
     * This is mainly useful when you need to override the Request class
     * to keep BC with an existing system. It should not be used for any
     * other purpose.
     */
    public static function setFactory(?callable $callable);

    /**
     * Sets a list of trusted proxies.
     *
     * You should only list the reverse proxies that you manage directly.
     *
     * @param array $proxies A list of trusted proxies, the string 'REMOTE_ADDR' will be replaced with $_SERVER['REMOTE_ADDR']
     * @param int $trustedHeaderSet A bit field of Request::HEADER_*, to set which headers to trust from your proxies
     *
     * @throws \InvalidArgumentException When $trustedHeaderSet is invalid
     */
    public static function setTrustedProxies(array $proxies, int $trustedHeaderSet);

    /**
     * Gets the list of trusted proxies.
     *
     * @return array An array of trusted proxies
     */
    public static function getTrustedProxies();

    /**
     * Enables support for the _method request parameter to determine the intended HTTP method.
     *
     * Be warned that enabling this feature might lead to CSRF issues in your code.
     * Check that you are using CSRF tokens when required.
     * If the HTTP method parameter override is enabled, an html-form with method "POST" can be altered
     * and used to send a "PUT" or "DELETE" request via the _method request parameter.
     * If these methods are not protected against CSRF, this presents a possible vulnerability.
     *
     * The HTTP method can only be overridden when the real HTTP method is POST.
     */
    public static function enableHttpMethodParameterOverride();

    /**
     * Whether the request contains a Session object.
     *
     * This method does not give any information about the state of the session object,
     * like whether the session is started or not. It is just a way to check if this Request
     * is associated with a Session instance.
     *
     * @return bool true when the Request contains a Session object, false otherwise
     */
    public function hasSession();

    /**
     * Returns the path being requested relative to the executed script.
     *
     * The path info always starts with a /.
     *
     * Suppose this request is instantiated from /mysite on localhost:
     *
     *  * http://localhost/mysite              returns an empty string
     *  * http://localhost/mysite/about        returns '/about'
     *  * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
     *  * http://localhost/mysite/about?var=1  returns '/about'
     *
     * @return string The raw path (i.e. not urldecoded)
     */
    public function getPathInfo();

    /**
     * Returns the root path from which this request is executed.
     *
     * Suppose that an index.php file instantiates this request object:
     *
     *  * http://localhost/index.php         returns an empty string
     *  * http://localhost/index.php/page    returns an empty string
     *  * http://localhost/web/index.php     returns '/web'
     *  * http://localhost/we%20b/index.php  returns '/we%20b'
     *
     * @return string The raw path (i.e. not urldecoded)
     */
    public function getBasePath();

    /**
     * Gets the user info.
     *
     * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
     */
    public function getUserInfo();

    /**
     * Returns the host name.
     *
     * This method can read the client host name from the "X-Forwarded-Host" header
     * when trusted proxies were set via "setTrustedProxies()".
     *
     * The "X-Forwarded-Host" header must contain the client host name.
     *
     * @return string
     *
     * @throws SuspiciousOperationException when the host name is invalid or not trusted
     */
    public function getHost();

    /**
     * Gets the request format.
     *
     * Here is the process to determine the format:
     *
     *  * format defined by the user (with setRequestFormat())
     *  * _format request attribute
     *  * $default
     *
     * @return string|null The request format
     * @see getPreferredFormat
     *
     */
    public function getRequestFormat(?string $default = 'html');

    /**
     * Sets the request format.
     */
    public function setRequestFormat(?string $format);

    /**
     * Sets the default locale.
     */
    public function setDefaultLocale(string $locale);

    /**
     * Sets the locale.
     */
    public function setLocale(string $locale);

    /**
     * Checks whether the method is cacheable or not.
     *
     * @see https://tools.ietf.org/html/rfc7231#section-4.2.3
     *
     * @return bool True for GET and HEAD, false otherwise
     */
    public function isMethodCacheable();

    /**
     * Gets the Etags.
     *
     * @return array The entity tags
     */
    public function getETags();

    /**
     * Indicates whether this request originated from a trusted proxy.
     *
     * This can be useful to determine whether or not to trust the
     * contents of a proxy-specific header.
     *
     * @return bool true if the request came from a trusted proxy, false otherwise
     */
    public function isFromTrustedProxy();

    /**
     * Get the current decoded path info for the request.
     *
     * @return string
     */
    public function decodedPath();

    /**
     * Get the client IP addresses.
     *
     * @return array
     */
    public function ips();

    /**
     * Get the client user agent.
     *
     * @return string
     */
    public function userAgent();

    /**
     * Get the session associated with the request.
     *
     * @return \Illuminate\Session\Store|null
     */
    public function getSession();

    /**
     * Get the value at the given offset.
     *
     * @param string $offset
     * @return mixed
     */
    public function offsetGet($offset);

    /**
     * Whether the request contains a Session which was started in one of the
     * previous requests.
     *
     * @return bool
     */
    public function hasPreviousSession();

    /**
     * @internal
     */
    public function setSessionFactory(callable $factory);

    /**
     * Returns the root URL from which this request is executed.
     *
     * The base URL never ends with a /.
     *
     * This is similar to getBasePath(), except that it also includes the
     * script filename (e.g. index.php) if one exists.
     *
     * @return string The raw URL (i.e. not urldecoded)
     */
    public function getBaseUrl();

    /**
     * Gets the scheme and HTTP host.
     *
     * If the URL was called with basic authentication, the user
     * and the password are not added to the generated string.
     *
     * @return string The scheme and HTTP host
     */
    public function getSchemeAndHttpHost();

    /**
     * Generates a normalized URI for the given path.
     *
     * @param string $path A path to use instead of the current one
     *
     * @return string The normalized URI for the path
     */
    public function getUriForPath(string $path);

    /**
     * Generates the normalized query string for the Request.
     *
     * It builds a normalized query string, where keys/value pairs are alphabetized
     * and have consistent escaping.
     *
     * @return string|null A normalized query string for the Request
     */
    public function getQueryString();

    /**
     * Get the default locale.
     *
     * @return string
     */
    public function getDefaultLocale();

    /**
     * Checks if the request method is of specified type.
     *
     * @param string $method Uppercase request method (GET, POST etc)
     *
     * @return bool
     */
    public function isMethod(string $method);

    /**
     * Checks whether or not the method is safe.
     *
     * @see https://tools.ietf.org/html/rfc7231#section-4.2.1
     *
     * @return bool
     */
    public function isMethodSafe();

    /**
     * Checks whether or not the method is idempotent.
     *
     * @return bool
     */
    public function isMethodIdempotent();

    /**
     * Returns the protocol version.
     *
     * If the application is behind a proxy, the protocol version used in the
     * requests between the client and the proxy and between the proxy and the
     * server might be different. This returns the former (from the "Via" header)
     * if the proxy is trusted (see "setTrustedProxies()"), otherwise it returns
     * the latter (from the "SERVER_PROTOCOL" server parameter).
     *
     * @return string
     */
    public function getProtocolVersion();

    /**
     * Returns the request body content.
     *
     * @param bool $asResource If true, a resource will be returned
     *
     * @return string|resource The request body content or a resource to read the body stream
     *
     * @throws \LogicException
     */
    public function getContent(bool $asResource = false);

    /**
     * Gets a list of charsets acceptable by the client browser.
     *
     * @return array List of charsets in preferable order
     */
    public function getCharsets();

    /**
     * Gets a list of encodings acceptable by the client browser.
     *
     * @return array List of encodings in preferable order
     */
    public function getEncodings();

    /**
     * Returns true if the request is a XMLHttpRequest.
     *
     * It works if your JavaScript library sets an X-Requested-With HTTP header.
     * It is known to work with common JavaScript frameworks:
     *
     * @see https://wikipedia.org/wiki/List_of_Ajax_frameworks#JavaScript
     *
     * @return bool true if the request is an XMLHttpRequest, false otherwise
     */
    public function isXmlHttpRequest();

    /**
     * Get the current path info for the request.
     *
     * @return string
     */
    public function path();

    /**
     * Determine if the request is the result of an AJAX call.
     *
     * @return bool
     */
    public function ajax();

    /**
     * Merge new input into the current request's input array.
     *
     * @param array $input
     * @return $this
     */
    public function merge(array $input);

    /**
     * Get the route handling the request.
     *
     * @param string|null $param
     * @param mixed $default
     * @return \Illuminate\Routing\Route|object|string|null
     */
    public function route($param = null, $default = null);

    /**
     * Set the JSON payload for the request.
     *
     * @param \Symfony\Component\HttpFoundation\ParameterBag $json
     * @return $this
     */
    public function setJson($json);

    /**
     * Get the user resolver callback.
     *
     * @return \Closure
     */
    public function getUserResolver();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules();

    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validateResolved();
}
