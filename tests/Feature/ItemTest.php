<?php
declare(strict_types=1);

use App\Item;
use App\User;

/**
 * Class ItemTest
 *
 * @covers \App\Http\Controllers\ItemController
 * @todo Only Feature Tests
 */
class ItemTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    public function testItemControllerShouldRedirectToLoginPageIfUserIsNotLoggedIn()
    {
        $this->followingRedirects()->get('/item')->assertViewIs('auth.login');
    }

    public function testIndex()
    {
        $this->login();
        $itemCollection = factory(Item::class, 5)->create();

        $this->followingRedirects()->get('/item')->assertViewIs('item.index')
            ->assertSee($itemCollection->find(1)->name)
            ->assertSee($itemCollection->find(2)->name)
            ->assertSee($itemCollection->find(3)->name)
            ->assertSee($itemCollection->find(4)->name)
            ->assertSee($itemCollection->find(5)->name);
    }

    public function testCreate()
    {
        $this->login();

        $this->followingRedirects()->get('/item/create')
            ->assertViewIs('item.create')
            ->assertSee(__('item.name'))
            ->assertSee(__('item.description'))
            ->assertSee(__('item.amount'));
    }

    public function testStore()
    {
        $this->login();

        $item = factory(Item::class)->make();

        $this->followingRedirects()
            ->post('/item', [
                'name' => $item->name,
                'description' => $item->description,
                'amount' => $item->amount
            ])->assertViewIs('item.show');
    }

    public function testStoreRedirectsBackToCreateOnFail()
    {
        $this->login();

        $this->followingRedirects()->post('/item', [
            'name' => null,
            'description' => null,
            'amount' => null
        ])
            ->assertSee( __('item.name_required'))
            ->assertSee( __('item.description_required'))
            ->assertSee( __('item.amount_required'));
    }

    public function testShow()
    {
        $user = $this->login();

        $item = factory(Item::class)->create(['created_by' => $user->id]);

        $this->followingRedirects()->get('/item/' . $item->id)
            ->assertViewIs('item.show')
            ->assertSee($item->id)
            ->assertSee($item->name)
            ->assertSee($item->description)
            ->assertSee($user->name)
            ->assertSee($item->amount);
    }

    public function testShowRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->get('/item/55555555')
            ->assertViewIs('item.index')
            ->assertSee(__('item.not_found'));
    }

    public function testEdit()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->get('/item/' . $item->id . '/edit')
            ->assertViewIs('item.edit')
            ->assertSee(__('item.name'))
            ->assertSee(__('item.description'))
            ->assertSee(__('item.amount'));
    }

    public function testEditRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->get('/item/55555555/edit')
            ->assertViewIs('item.index')
            ->assertSee(__('item.not_found'));
    }

    public function testUpdate()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->put('/item/' . $item->id, [
            'name' => 'new name',
            'description' => 'new description',
            'amount' => '987'
        ])
            ->assertViewIs('item.show')
            ->assertSee('new name')
            ->assertSee('new description')
            ->assertSee('987')
            ->assertSee(__('item.update_successful'));
    }

    public function testUpdateRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->put('/item/' . '55555555', [
            'name' => 'new name',
            'description' => 'new description',
            'amount' => '987'
        ])
            ->assertSee(__('item.update_unsuccessful'));
    }

    public function testDelete()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->delete('/item/' . $item->id)
            ->assertSee(__('item.delete_successful'));
    }

    public function testDeleteRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->delete('/item/55555')
            ->assertSee(__('item.delete_unsuccessful'));
    }
}
