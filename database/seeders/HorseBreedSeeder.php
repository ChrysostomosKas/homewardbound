<?php

namespace Database\Seeders;

use App\Models\HorseBreed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorseBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horseBreeds = [
            'Aegidienberger' => ['Αιγιδιένμπεργκερ', 'Aegidienberger'],
            'American Cream Draft' => ['Αμερικανικό Κριμ Ντραφτ', 'American Cream Draft'],
            'American Miniature Horse' => ['Αμερικανικό Ελαφρά Τραπ', 'American Miniature Horse'],
            'American Paint Horse' => ['Αμερικανικό Πειντ Χορς', 'American Paint Horse'],
            'American Quarter Horse' => ['Αμερικανικό Κουάρτερ Χορς', 'American Quarter Horse'],
            'American Saddlebred' => ['Αμερικανικό Σάντλμπρεντ', 'American Saddlebred'],
            'American Sugarbush Harlequin Draft' => ['Αμερικανικό Σάγκαρμπους Χαρλεκίν Ντραφτ', 'American Sugarbush Harlequin Draft'],
            'Andalusian' => ['Ανδαλουσιανός', 'Andalusian'],
            'Appaloosa' => ['Απαλούζα', 'Appaloosa'],
            'Arabian' => ['Αράβικος', 'Arabian'],
            'Bajau Pony' => ['Πόνυ Μπαχάου', 'Bajau Pony'],
            'Black Forest Horse' => ['Μαύρο Δάσος Ιππός', 'Black Forest Horse'],
            'Blazer' => ['Μπλέιζερ', 'Blazer'],
            'British Appaloosa' => ['Βρετανική Απαλούζα', 'British Appaloosa'],
            'British Riding Pony' => ['Βρετανικό Πόνυ Ιππασίας', 'British Riding Pony'],
            'British Spotted Pony' => ['Βρετανικό Πόνυ με Σημάδια', 'British Spotted Pony'],
            'Camarillo White Horse' => ['Άλογο Καμαρίγιο Λευκό', 'Camarillo White Horse'],
            'Caspian' => ['Κασπιανός', 'Caspian'],
            'Cheval Canadien' => ['Σεβάλ Καναδικός', 'Cheval Canadien'],
            'Cleveland Bay' => ['Κλίβελαντ Μπέι', 'Cleveland Bay'],
            'Colorado Ranger' => ['Κολοράντο Ρέιντζερ', 'Colorado Ranger'],
            'Connemara Pony' => ['Πόνυ Κονέμαρα', 'Connemara Pony'],
            'Curly Horse' => ['Κερλι Χορς', 'Curly Horse'],
            'Dales Pony' => ['Πόνυ Ντέιλς', 'Dales Pony'],
            'Dartmoor Pony' => ['Πόνυ Νταρτμούρ', 'Dartmoor Pony'],
            'Eriskay Pony' => ['Πόνυ Έρισκεϊ', 'Eriskay Pony'],
            'Exmoor Pony' => ['Πόνυ Έξμουρ', 'Exmoor Pony'],
            'Faroese Pony' => ['Πόνυ Φαρόε', 'Faroese Pony'],
            'Florida Cracker Horse' => ['Άλογο Φλόριντα Κράκερ', 'Florida Cracker Horse'],
            'Friesian' => ['Φρίσιαν', 'Friesian'],
            'Friesian Heritage Horse' => ['Άλογο Φρίσιαν Παραδοσιακής Κληρονομιάς', 'Friesian Heritage Horse'],
            'Galiceno' => ['Γαλισιένο', 'Galiceno'],
            'Georgian Grande' => ['Γεωργιανό Γκραντ', 'Georgian Grande'],
            'Gypsy Vanner' => ['Γύψυ Βάνερ', 'Gypsy Vanner'],
            'Icelandic' => ['Ισλανδικό', 'Icelandic'],
            'Irish Cob' => ['Ιρλανδικό Κομπ', 'Irish Cob'],
            'Irish Draught' => ['Ιρλανδικό Σχέδιο', 'Irish Draught'],
            'Kentucky Mountain Saddle Horse' => ['Κεντάκι Ιππός Σέλας του Βουνού', 'Kentucky Mountain Saddle Horse'],
            'Kerry Bog Pony' => ['Πόνυ της Κέρρυ', 'Kerry Bog Pony'],
            'Kuda Padi' => ['Κούντα Πάντι', 'Kuda Padi'],
            'Lombok Horse' => ['Άλογο Λομπόκ', 'Lombok Horse'],
            'McCurdy Plantation Horse' => ['Άλογο ΜακΚέρντι Φυτείας', 'McCurdy Plantation Horse'],
            'Missouri Fox Trotter' => ['Μιζούρι Φοξ Τρότερ', 'Missouri Fox Trotter'],
            'Morab' => ['Μόραμπ', 'Morab'],
            'Morgan' => ['Μόργκαν', 'Morgan'],
            'Moriesian' => ['Μόρειζιαν', 'Moriesian'],
            'Mountain Pleasure Horse' => ['Άλογο Ιππασίας του Βουνού', 'Mountain Pleasure Horse'],
            'National Show Horse' => ['Εθνικό Άλογο Επιδείξεων', 'National Show Horse'],
            'Forest Pony' => ['Πόνυ του Δάσους', 'Forest Pony'],
            'Newfoundland Pony' => ['Πόνυ της Νιουφάντλαντ', 'Newfoundland Pony'],
            'Nez Perce Horse' => ['Άλογο Νεζ Περς', 'Nez Perce Horse'],
            'Norwegian Fjord' => ['Νορβηγικό Φιόρντ', 'Norwegian Fjord'],
            'Nokota' => ['Νοκότα', 'Nokota'],
            'Peruvian Horse' => ['Περουβιανό Άλογο', 'Peruvian Horse'],
            'Pintabian' => ['Πίνταμπιαν', 'Pintabian'],
            'Racking Horse' => ['Ράκινγκ Χορς', 'Racking Horse'],
            'Quarab' => ['Κουαράμπ', 'Quarab'],
            'Quarter Pony' => ['Τέταρτο Πόνυ', 'Quarter Pony'],
            'Rocky Mountain Horse' => ['Άλογο του Ρόκι Μάουντεν', 'Rocky Mountain Horse'],
            'Shire' => ['Σάιρ', 'Shire'],
            'Smokey Valley Horse' => ['Άλογο Σμόκι Βάλεϋ', 'Smokey Valley Horse'],
            'Spanish Mustang' => ['Ισπανικό Μαστάνγκ', 'Spanish Mustang'],
            'Spotted Saddle Horse' => ['Άλογο Σέλας με Σημάδια', 'Spotted Saddle Horse'],
            'Standardbred' => ['Στάνταρντμπρεντ', 'Standardbred'],
            'Stonewall Sporthorse' => ['Άλογο Σπορ Στόουνγουολ', 'Stonewall Sporthorse'],
            'Sulphur Horse' => ['Άλογο Θειώδες', 'Sulphur Horse'],
            'Sumba Horse' => ['Άλογο Σούμπα', 'Sumba Horse'],
            'Tennessee Walking Horse' => ['Άλογο Τενεσί Ολομπέικινγκ', 'Tennessee Walking Horse'],
            'Thoroughbred' => ['Θορόμπρεντ', 'Thoroughbred'],
            'Walkaloosa' => ['Γουόκαλούζα', 'Walkaloosa'],
            'Welara Pony' => ['Πόνυ Ουέλαρα', 'Welara Pony'],
            'Welsh Pony & Cob' => ['Ουέλς Πόνυ και Κομπ', 'Welsh Pony & Cob'],
        ];

        foreach ($horseBreeds as $breed) {
            HorseBreed::create([
                'name_gr' => $breed[0], // Greek name
                'name_en' => $breed[1], // English name
            ]);
        }
    }
}
