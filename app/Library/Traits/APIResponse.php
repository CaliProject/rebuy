<?php

namespace Rebuy\Library\Traits;

trait APIResponse {

    /**
     * Return success response accordingly.
     *
     * @param array|string $attributes
     * @param null         $to
     * @return array
     *
     * @author Cali
     */
    protected function successResponse($attributes = [], $to = null)
    {
        // 请求是否为ajax
        if (request()->ajax()) {
            // 获取json数组
            $response = $this->ajaxSuccessResponse($attributes);

            return $to ?
                array_merge($response, [
                    'redirect' => str_contains($to, '://') ? $to : url($to)
                ]) : $response;
        }

        return $to ?
            redirect($to)->with($this->ajaxSuccessResponse($attributes)) :
            redirect()->back()->with($this->ajaxSuccessResponse($attributes));
    }

    /**
     * Return error response accordingly.
     *
     * @param array|string $attributes
     * @param null         $to
     * @return array
     *
     * @author Cali
     */
    protected function errorResponse($attributes = [], $to = null)
    {
        if (request()->ajax()) {
            $response = $this->ajaxErrorResponse($attributes);

            return $to ?
                array_merge($response, [
                    'redirect' => str_contains($to, '://') ? $to : url($to)
                ]) : $response;
        }

        return $to ?
            redirect($to)->with($this->ajaxErrorResponse($attributes)) :
            redirect()->back()->with($this->ajaxErrorResponse($attributes));
    }

    /**
     * Return success response for AJAX request.
     *
     * @param array|string $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxSuccessResponse($attributes)
    {
        return is_string($attributes) ? [
            'status'  => 'success',
            'message' => $attributes,
        ] : array_merge(
            ['status' => 'success',],
            $attributes
        );
    }

    /**
     * Return error response for AJAX request.
     *
     * @param array|string $attributes
     * @return array
     *
     * @author Cali
     */
    protected function ajaxErrorResponse($attributes)
    {
        return is_string($attributes) ? [
            'status'  => 'error',
            'message' => $attributes
        ] : array_merge(
            ['status' => 'error',],
            $attributes
        );
    }
}