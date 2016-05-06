<?php

namespace Rebuy\Http\Requests;

use Rebuy\Http\Requests\Request;

class PostFormRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required',
            'body'      => 'required',
            'video_src' => 'required_if:type,1|url'
        ];
    }
}
