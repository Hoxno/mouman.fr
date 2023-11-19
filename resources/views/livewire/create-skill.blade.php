<div>
    <form wire:submit.prevent="save">
        <div>
            <label for="title">Titre :</label>
            <input type="text" wire:model="title">
            @error('title') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="level">Niveau :</label>
            <input type="text" wire:model="level">
            @error('level') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="description">Description :</label>
            <textarea wire:model="description"></textarea>
            @error('description') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</div>