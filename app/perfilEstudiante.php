<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


class perfilEstudiante extends Model
{
    use SoftDeletes;
    
    protected $table = 'student_profile';

    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'name',
        'lastname',
        'id_document_type',
        'document_number',
        'url_document_type',
        'document_expedition_date',
        'email',
        'birth_date',
        'id_birth_city',
        'sex',
        'id_gender',
        'cellphone',
        'phone',
        'id_neighborhood',
        'direction',
        'id_group',
        'id_cohort',
        'id_tutor',
    ];

    protected $dates = ['delete_at'];

    //relaciones uno a uno por debajo
    public function documenttype(){

        return $this->hasOne(DocumentType::class, 'id', 'id_document_type');
    }

    public function birthcity(){
        return $this->hasOne(BirthCity::class, 'id', 'id_birth_city');
    }

    public function gender(){
        return $this->hasOne(Gender::class, 'id', 'id_gender');
    }

    public function neighborhood(){
        return $this->hasOne(Neighborhood::class, 'id', 'id_neighborhood');
    }

    public function tutor(){
        return $this->hasOne(Tutor::class, 'document_number', 'id_tutor');
    }

    public function group(){
        return $this->hasOne(Group::class, 'id', 'id_group');
    }

    public function socioeconomicdata(){

        return $this->hasOne(SocioeconomicData::class, 'id_student', 'id');
    }

    public function academicdata(){

        return $this->hasOne(AcademicDates::class, 'id_student', 'id');
    }

    public function admissionScores(){

        return $this->hasOne(AdmissionScores::class, 'id_student', 'id');
    }
}

