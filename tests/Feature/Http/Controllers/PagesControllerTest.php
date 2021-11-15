<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_frontend_page_that_exists_shows_the_correct_view()
    {
        $existingPages = collect([
            'login'    => 'auth.login',
            'register' => 'auth.register',
            'index'    => 'pages.index'
        ]);
        foreach($existingPages as $page => $view) {
            $response = $this->get(route('pages.show', $page));
            $response->assertStatus(200);
            $response->assertViewIs($view);
        }
    }

    /** @test */
    public function a_frontend_page_that_doesnt_exists_shows_a_404()
    {
        $pages = collect(['foo', 'bar', 'foobar']);
        foreach($pages as $page) {
            $response = $this->get(route('pages.show', $page));
            $response->assertStatus(404);
        }

    }
}
