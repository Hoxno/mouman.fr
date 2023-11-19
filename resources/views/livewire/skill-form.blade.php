<td colspan="4">
    <form action="" wire:submit.prevent="save">
        <div class="w-full">
            <label for="title">Titre :</label>
            <input type="text" wire:model.defer="skill.title" class="w-full">
            @error('skill.title') <span>{{ $message }}</span> @enderror
        </div>
        <div class="button">
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</td>
