<?php

use App\Models\User;
use App\Models\Menu;

test('guest is redirected to login when trying to access menu or pax', function () {
    $this->get('/menu/pax')->assertRedirect('/login');
    $this->get('/menu')->assertRedirect('/login');
    $this->get('/menu/manage')->assertRedirect('/login');
});

test('normal user can access pax entry page', function () {
    $user = User::factory()->create(['usertype' => 'user']);

    $response = $this->actingAs($user)->get('/menu/pax');

    $response->assertOk();
    $response->assertViewIs('menu.pax');
});

test('normal user dashboard route returns dashboard view', function () {
    $user = User::factory()->create(['usertype' => 'user']);

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk();
    $response->assertViewIs('dashboard');
});

test('normal user can submit pax & budget form and is redirected to menu page', function () {
    $user = User::factory()->create(['usertype' => 'user']);

    $response = $this->actingAs($user)->post('/menu/pax', [
        'pax' => 4,
        'budget' => 150.50,
    ]);

    $response->assertRedirect(route('menu.index'));
    $this->assertEquals(4, session('pax'));
    $this->assertEquals(150.50, session('budget'));
});

test('normal user can view menu index with correct pax and budget variables', function () {
    $user = User::factory()->create(['usertype' => 'user']);

    $response = $this->actingAs($user)
        ->withSession(['pax' => 4, 'budget' => 150.50])
        ->get('/menu');

    $response->assertOk();
    $response->assertViewIs('menu.index');
    $response->assertViewHas('pax', 4);
    $response->assertViewHas('budget', 150.50);
});

test('normal user cannot access admin menu management routes', function () {
    $user = User::factory()->create(['usertype' => 'user']);

    $this->actingAs($user)->get('/menu/manage')->assertStatus(403);
    $this->actingAs($user)->get('/menu/create')->assertStatus(403);
});

test('admin dashboard route redirects to admin dashboard', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);

    $response = $this->actingAs($admin)->get('/dashboard');

    $response->assertRedirect(route('admin.dashboard'));
});

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertOk();
    $response->assertViewIs('admin.dashboard');
});

test('admin can access menu management page', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);

    $response = $this->actingAs($admin)->get('/menu/manage');

    $response->assertOk();
    $response->assertViewIs('menu.manage');
});

test('admin can create a new menu item', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);

    $response = $this->actingAs($admin)->post('/menu', [
        'name' => 'Nasi Lemak Special',
        'price' => 12.50,
        'category' => 'Main Course',
        'description' => 'Delicious traditional coconut rice.',
    ]);

    $response->assertRedirect(route('menu.manage'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('menus', [
        'name' => 'Nasi Lemak Special',
        'price' => 12.50,
        'category' => 'Main Course',
    ]);
});

test('admin can update an existing menu item', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);
    $menu = Menu::create([
        'name' => 'Original Burger',
        'price' => 15.00,
        'category' => 'Main Course',
        'description' => 'Classic beef burger',
    ]);

    $response = $this->actingAs($admin)->put("/menu/{$menu->id}", [
        'name' => 'Premium Cheeseburger',
        'price' => 18.50,
        'category' => 'Main Course',
        'description' => 'Upgraded cheeseburger',
    ]);

    $response->assertRedirect(route('menu.manage'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('menus', [
        'id' => $menu->id,
        'name' => 'Premium Cheeseburger',
        'price' => 18.50,
    ]);
});

test('admin can delete a menu item', function () {
    $admin = User::factory()->create(['usertype' => 'admin']);
    $menu = Menu::create([
        'name' => 'Temp Menu Item',
        'price' => 5.00,
        'category' => 'Snack',
    ]);

    $response = $this->actingAs($admin)->delete("/menu/{$menu->id}");

    $response->assertRedirect(route('menu.manage'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('menus', [
        'id' => $menu->id,
    ]);
});
