<?php
// ─── Client.php ───────────────────────────────────────────────────────────────
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'client_id';
    protected $fillable   = ['client_fname','client_mname','client_lname','client_name','contact_person','address','phone','email'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function getFullNameAttribute(): string
    {
        $parts = array_filter([
            $this->client_fname,
            $this->client_mname,
            $this->client_lname,
        ]);

        return !empty($parts) ? implode(' ', $parts) : (string) $this->client_name;
    }
}
