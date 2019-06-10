@extends('layout')
@section('content')
    <template v-if="menu==0">
        <Donacion></Donacion>
    </template>
    <template v-if="menu==1">
        <Nivel></Nivel>
    </template>
    <template v-if="menu==2">
        <Responsable></Responsable>
    </template>
    <template v-if="menu==3">
        <Alumno></Alumno>
    </template>
    <!-- <template v-if="menu==4">
        <Morbilidad></Morbilidad>
    </template> -->
    <template v-if="menu==5">
        <Gasto></Gasto>
    </template>
    <template v-if="menu==6">
        <Nuevo></Nuevo>
    </template>
    <template v-if="menu==7">
        <Datos></Datos>
    </template>
    <template v-if="menu==8">
        <Diagnostico></Diagnostico>
    </template>
    <template v-if="menu==9">
        <Reportes></Reportes>
    </template>
@endsection