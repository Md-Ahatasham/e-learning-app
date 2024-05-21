<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ToSweetAlert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('success')) {
            alert()->success($request->session()->get('success'));
        }

        if ($request->session()->has('info')) {
            alert()->info($request->session()->get('info'));
        }

        if ($request->session()->has('warning')) {
            alert()->warning($request->session()->get('warning'));
        }

        if ($request->session()->has('question')) {
            alert()->question($request->session()->get('question'));
        }

        if ($request->session()->has('info')) {
            alert()->info($request->session()->get('info'));
        }

        if ($request->session()->has('errors') && config('sweetalert.middleware.auto_display_error_messages')) {
            $error = $request->session()->get('errors');

            if (!is_string($error)) {
                $error = $this->getErrors($error->getMessages());
            }

            alert()->error($error);
        }

        if ($request->session()->has('toast_success')) {
            alert()->toast($request->session()->get('toast_success'), 'success')->middleware()->autoClose(3000);
        }

        if ($request->session()->has('toast_info')) {
            toast($request->session()->get('toast_info'), 'info')->middleware();
        }

        if ($request->session()->has('toast_warning')) {
            toast($request->session()->get('toast_warning'), 'warning')->middleware()->autoClose(3000);
        }

        if ($request->session()->has('toast_question')) {
            toast($request->session()->get('toast_question'), 'question')->middleware();
        }

        if ($request->session()->has('toast_error')) {
            toast($request->session()->get('toast_error'), 'error')->middleware()->autoClose(3000);
        }

        return $next($request);
    }

    /**
     * Get the validation errors
     *
     * @param object $errors
     * @author Rashid Ali <realrashid05@gmail.com>
     */
    private function getErrors($errors)
    {
        $errors = collect($errors);
        return $errors->flatten()->implode('<br />');
    }
}
