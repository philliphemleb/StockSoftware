<?php
declare(strict_types=1);

namespace Tests\Feature;
use App\Category;
use App\Item;
use App\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ItemControllerTest
 *
 * @covers \App\Http\Controllers\ItemController
 */
class ItemControllerTest extends TestCase
{
    use DatabaseMigrations;

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
            ->assertSee('Name')
            ->assertSee('Beschreibung')
            ->assertSee('Anzahl')
            ->assertSee('Erstellen');
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
            ])->assertViewIs('item.edit');
    }

    public function testStoreRedirectsBackToCreateOnFail()
    {
        $this->login();

        $this->followingRedirects()->post('/item', [
            'name' => null,
            'description' => null,
            'amount' => null
        ])
            ->assertSee('Ein Name ist erforderlich')
            ->assertSee('Eine Beschreibung ist erforderlich')
            ->assertSee('Die Anzahl ist erforderlich');
    }

    public function testStoreRedirectsBackToCreateIfAmountIsTooHigh()
    {
        $this->login();

        $this->followingRedirects()->post('/item', [
            'name' => 'name',
            'description' => 'description',
            'amount' => 1e99
        ])
            ->assertSee('Die Anzahl ist zu hoch');
    }

    public function testShow()
    {
        $user = $this->login();

        $item = factory(Item::class)->create(['user_id' => $user->id]);

        $this->followingRedirects()->get('/item/' . $item->id)
            ->assertViewIs('item.edit');
    }

    public function testEdit()
    {
        $this->login();

        $item = factory(Item::class)->create();
        $item->tags()->saveMany(factory(Tag::class, 3)->create());
        $item->categories()->saveMany(factory(Category::class, 3)->create());

        $this->followingRedirects()->get('/item/' . $item->id . '/edit')
            ->assertViewIs('item.edit')
            ->assertSee($item->id)
            ->assertSee($item->user->name)
            ->assertSee('Name')
            ->assertSee($item->name)
            ->assertSee('Beschreibung')
            ->assertSee($item->description)
            ->assertSee('Anzahl')
            ->assertSee($item->amount)
            ->assertSee('Tags hinzufügen')
            ->assertSee('Tags löschen')
            ->assertSee('Kategorien hinzufügen')
            ->assertSee('Kategorien löschen')
            ->assertSee('Einzelne Tags mit einem Komma trennen')
            ->assertSee($item->tags[0]->name)
            ->assertSee($item->tags[1]->name)
            ->assertSee($item->tags[2]->name)
            ->assertSee($item->categories[0]->name)
            ->assertSee($item->categories[1]->name)
            ->assertSee($item->categories[2]->name)
            ->assertSee('Bestätigen');
    }

    public function testEditRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->get('/item/55555555/edit')
            ->assertViewIs('item.index')
            ->assertSee('Angegebene ID wurde nicht gefunden');
    }

    public function testUpdate()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->put('/item/' . $item->id, [
            'name' => 'new name',
            'description' => 'new description',
            'amount' => 987,
            'tags' => 'not Created Tag, firstExistingTag, SecondExisting Tag'
        ])
            ->assertViewIs('item.edit')
            ->assertSee('new name')
            ->assertSee('new description')
            ->assertSee('987')
            ->assertSee('Erfolgreich aktualisiert')
            ->assertSee('not Created Tag')
            ->assertSee('firstExistingTag')
            ->assertSee('SecondExisting Tag');
    }

    public function testUpdateRedirectsBackOnError()
    {
        $this->login();

        $this->followingRedirects()->put('/item/' . '55555555', [
            'name' => 'new name',
            'description' => 'new description',
            'amount' => 987
        ])
            ->assertSee('Konnte nicht aktualisiert werden');
    }

    public function testUpdateRedirectsBackIfAmountIsTooHigh()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->put('/item/' . $item->id, [
            'name' => 'new name',
            'description' => 'new description',
            'amount' => 1e99,
            'tags' => 'not Created Tag, firstExistingTag, SecondExisting Tag'
        ])
            ->assertSee('Die Anzahl ist zu hoch');
    }

    public function testDelete()
    {
        $this->login();

        $item = factory(Item::class)->create();

        $this->followingRedirects()->delete('/item/' . $item->id)
            ->assertSee('Erfolgreich gelöscht');
    }

    public function testDeleteRedirectsToIndexOnError()
    {
        $this->login();

        $this->followingRedirects()->delete('/item/55555')
            ->assertSee('Konnte nicht gelöscht werden');
    }
}
