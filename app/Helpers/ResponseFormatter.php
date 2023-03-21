<?php

namespace App\Helpers;

class ResponseFormatter
{
  protected static $response = [
    'meta' => [
      'code' => 200,
      'status' => 'success',
      'message' => null
    ],
    'data' => null
  ];

  public static function success($data = null, $message = null, $code = null)
  {
    if($code !== null){
      self::$response['meta']['code'] = $code;
    }
    self::$response['meta']['message'] = $message;
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

  public static function error($data = null, $message = null, $code = 400)
  {
    self::$response['meta']['status'] = 'error';
    self::$response['meta']['code'] = $code;
    self::$response['meta']['message'] = $message;
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

  public static function errorUserNotHaveRightPermission()
  {
    self::$response['meta']['status'] = 'Error';
    self::$response['meta']['code'] = 403;
    self::$response['meta']['message'] = "User doesn't have right permission";
    self::$response['data'] = null;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

  public static function errorServerError($data)
  {
    self::$response['meta']['status'] = 'Error';
    self::$response['meta']['code'] = 500;
    self::$response['meta']['message'] = 'Something went wrong';
    self::$response['data'] = $data;

    return response()->json(self::$response, self::$response['meta']['code']);
  }

}
