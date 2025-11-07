<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'idcompany';

    protected $fillable = [
        'company_name',
        'legal_representative_name',
        'legal_representative_lastname',
        'legal_representative_dni',
        'legal_representative_email',
        'rfc',
        'terms_and_conditions',
        'pdf_ine_certificate',
        'pdf_bank_certificate',
        'profile_photo',
        'account_holder_name',
        'account_holder_email',
        'bank_name',
        'account_number',
        'account_iban',
        'billing_contact_name',
        'billing_contact_email',
        'users_iduser',
    ];

    public function getRouteKeyName()
    {
        return 'idcompany';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_iduser', 'iduser');
    }
}
