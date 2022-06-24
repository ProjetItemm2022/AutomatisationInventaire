@extends('assignation/layouts')

@push('title')
    Délimitation des zones
@endpush

@push('head')
    <script src="{{ asset('js/assignationZone.js') }}" defer type="module"></script>
@endpush


@push('modal-title')
    Selection de la salle qui contient la zone
@endpush

@push('modal-body')
    <label for="name-select"> <h2>Veuillez choisir la salle qui contient la zone</h2></label>
    <select id="select-salle" class="form-select">
    </select>
@endpush
