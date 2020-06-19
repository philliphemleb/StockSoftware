<?php

namespace Tests\Feature;

use App\Filter;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class FilterTest
 * @package Tests\Feature
 * @covers \App\Http\Controllers\FilterController
 */
class FilterTest extends TestCase
{
    use DatabaseMigrations;

    public function testFilterControllerShouldRedirectToLoginPageIfUserIsNotLoggedIn()
    {
        $this->followingRedirects()->get('/filter')->assertViewIs('auth.login');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->login();

        $filterCollection = factory(Filter::class, 5)->create();

        $this->followingRedirects()->get('/filter')->assertViewIs('filter.index')
            ->assertSee('Filter erstellen')
            ->assertSee($filterCollection->find(1)->name)
            ->assertSee($filterCollection->find(2)->name)
            ->assertSee($filterCollection->find(3)->name)
            ->assertSee($filterCollection->find(4)->name)
            ->assertSee($filterCollection->find(5)->name);
    }

    public function testCreate()
    {
        $this->login();

        $this->followingRedirects()->get('/filter/create')
            ->assertViewIs('filter.create')
            ->assertSee('Erstellung')
            ->assertSee('Filter')
            ->assertSee('Name')
            ->assertSee('Beschreibung')
            ->assertSee('Filter erstellen');
    }

    public function testStore()
    {
        $this->login();

        $filter = factory(Filter::class)->make();

        $this->followingRedirects()
            ->post('/filter', ['name' => $filter->name, 'description' => $filter->description])
            ->assertViewIs('filter.show');
    }

    public function testStoreRedirectsToEditIfDataIsMissing()
    {
        $this->login();

        $this->followingRedirects()
            ->post('/filter', ['name' => null, 'description' => null])
            ->assertViewIs('filter.create')
            ->assertSee(__('filter.name_required'))
            ->assertSee(__('filter.description_required'));
    }

    public function testShow()
    {
        $this->login();

        $filter = factory(Filter::class)->create();

        $this->get('/filter/' . $filter->id)
            ->assertViewIs('filter.show')
            ->assertSee($filter->name)
            ->assertSee($filter->description);
    }

    public function testShowRedirectsToIndexIfIdWasNotFound()
    {
        $this->login();

        $this->followingRedirects()->get('/filter/55555555')
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.not_found'));
    }

    public function testEdit()
    {
        $this->login();

        $filter = factory(Filter::class)->create();

        $this->followingRedirects()->get('/filter/' . $filter->id . '/edit')
            ->assertViewIs('filter.edit')
            ->assertSee(__('filter.name'))
            ->assertSee($filter->name)
            ->assertSee(__('filter.description'))
            ->assertSee($filter->description)
            ->assertSee(__('filter.submit'));
    }

    public function testEditRedirectsToIndexIfFilterWasNotFound()
    {
        $this->login();

        $this->followingRedirects()->get('/filter/55555555/edit')
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.not_found'));
    }

    public function testUpdate()
    {
        $this->login();

        $filter = factory(Filter::class)->create();

        $this->followingRedirects()->put('/filter/' . $filter->id, ['name' => 'New Name', 'description' => 'New Description'])
            ->assertViewIs('filter.show')
            ->assertSee('New Name')
            ->assertSee('New Description');
    }

    public function testUpdateRedirectsToIndexIfDataIsMissing()
    {
        $this->login();

        $filter = factory(Filter::class)->create();

        $this->followingRedirects()->put('/filter/' . $filter->id, ['name' => null, 'description' => null])
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.name_required'))
            ->assertSee(__('filter.description_required'));
    }

    public function testUpdateRedirectsToIndexIfFilterWasNotFound()
    {
        $this->login();

        $this->followingRedirects()->put('/filter/5555', ['name' => 'new Name', 'description' => 'new Description'])
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.update_unsuccessful'));
    }

    public function testDestroy()
    {
        $this->login();

        $filter = factory(Filter::class)->create();

        $this->followingRedirects()->delete('/filter/' . $filter->id)
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.delete_successful'))
            ->assertDontSee($filter->name);
    }

    public function testDestroyThrowsErrorIfFilterWasNotFound()
    {
        $this->login();

        $this->followingRedirects()->delete('/filter/5555')
            ->assertViewIs('filter.index')
            ->assertSee(__('filter.delete_unsuccessful'));
    }
}
