@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('header_title', 'Dashboard Ringkasan')

@section('content')
    <div style="display: flex; gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 4px solid #28a745;">
            <h4 style="margin: 0 0 10px 0; color: #666;">Pesanan Hari Ini</h4>
            <h2 style="margin: 0; color: #333;">24</h2>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 4px solid #007bff;">
            <h4 style="margin: 0 0 10px 0; color: #666;">Total Pelanggan</h4>
            <h2 style="margin: 0; color: #333;">150</h2>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; flex: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 4px solid #ffc107;">
            <h4 style="margin: 0 0 10px 0; color: #666;">Menu Aktif</h4>
            <h2 style="margin: 0; color: #333;">35</h2>
        </div>
    </div>
@endsection