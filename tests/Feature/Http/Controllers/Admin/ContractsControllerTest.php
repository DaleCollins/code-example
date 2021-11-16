<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\Helpers;
use Tests\TestCase;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractsControllerTest extends TestCase
{
    use RefreshDatabase, Helpers;

    public function setUp() : void
    {
        parent::setUp();
        $this->loginUser();
    }

    /** @test
     *  Index
     */
    public function the_index_page_shows_contracts()
    {
        $contract = Contract::factory()->create();
        $this->get(route('contracts.index'))
             ->assertViewIs('admin.contracts.index')
             ->assertSee($contract->name);
    }

    /** @test
     * Create
     */
    public function the_create_page_exists()
    {
        $this->get(route('contracts.create'))
             ->assertViewIs('admin.contracts.create');
    }

    /** @test
     * Store
     */
    public function a_contract_can_be_added_to_the_database_with_redirect_to_contracts_index()
    {
        $contract = Contract::factory()->raw();
        $this->post(route('contracts.store', $contract))
             ->assertRedirect(route('contracts.index'));
        $this->assertDatabaseHas('contracts', $contract);

    }

    /** @test
     * Show
     */
    public function an_individual_contract_can_be_shown()
    {
        $contract = Contract::factory()->create();
        $this->get(route('contracts.show', $contract->id))
             ->assertViewIs('admin.contracts.show')
             ->assertSee($contract->name);
    }

    /** @test
     * Edit
     */
    public function The_edit_page_exists_and_shows_the_correct_contract()
    {
        $contract = Contract::factory()->create();
        $this->get(route('contracts.edit', $contract->id))
             ->assertViewIs('admin.contracts.edit')
             ->assertSee($contract->name);
    }

    /** @test
     * Update
     */
    public function an_individual_contract_can_be_updated_with_redirect_to_contracts_show()
    {
        $contract = Contract::factory()->create();
        $contract->name = 'Updated Name';
        $this->patch(route('contracts.update', $contract), [
            'name' => $contract->name
        ])->assertRedirect(route('contracts.show', $contract));
        $this->assertDatabaseHas('contracts', ['name' => 'Updated Name']);
    }

    /** @test
     * Destroy
     */
    public function a_contract_can_be_deleted_with_redirect_to_contracts_index()
    {
        $contract = Contract::factory()->create();
        $this->delete(route('contracts.destroy', $contract))
             ->assertRedirect(route('contracts.index'));
        $this->assertDatabaseMissing('contracts', $contract->toArray());
    }

}
