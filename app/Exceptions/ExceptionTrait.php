<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait{

    public function apiException($request,$e)
    {
        if ($this->isModel($e)) {
                return $this->modelResponse();
        }
        if ($this->isHttp($e)) {
             return $this->httpResponse();
        }
        if ($this->isMethod($e)) {
           return $this->methodResponse();
        }
        return parent::render($request, $e);
    }

    protected function isModel($e)
    {
        return $e instanceof  ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function isMethod($e)
    {
      return  $e instanceof MethodNotAllowedHttpException;
    }

    protected function modelResponse()
    {
       return response()->json(['خطا'=>'چنین محصولی ثبت نشده است'],Response::HTTP_NOT_FOUND);
    }
    protected function httpResponse()
    {
        return response()->json(['خطا'=>'جنین آدرسی تعریف نشده است'],Response::HTTP_NOT_FOUND);
    }

    protected function methodResponse()
    {
     return response()->json(['خطا' => 'لطفا متد درخواست خود را بررسی کنید '], Response::HTTP_NOT_FOUND);

    }
}
