'use strict';

(function (window, document, $) {

	// Storage utility functions for DataTables state management
	window.storageSetItem = function(key, value) {
		try {
			localStorage.setItem(key, value);
		} catch (e) {
			console.warn('Failed to save to localStorage:', e);
		}
	};

	window.storageGetItem = function(key) {
		try {
			return localStorage.getItem(key);
		} catch (e) {
			console.warn('Failed to read from localStorage:', e);
			return null;
		}
	};

	var url_current_page = $('body').attr('url-current-page');
	var datatable = $('#daftar-user-admin');

	if (datatable.length) {
		datatable.DataTable({			
			order: [[1, 'asc']],
			processing: true,
			serverSide: true,
			searchDelay: 2700,
			language: {
				search: '<i class="ti ti-search ti-sm"></i>',
				searchPlaceholder: 'Cari Data',
				info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
				infoEmpty: 'Menampilkan 0 - 0 dari 0 data',
				infoFiltered: '(filtered from _MAX_ total entries)',
				paginate: {
					next: '<i class="ti ti-chevron-right ti-sm"></i>',
					previous: '<i class="ti ti-chevron-left ti-sm"></i>',
				},
				emptyTable: 'Tidak ada data user superadmin yang tersedia'
			},
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sortable: false },
				{ data: 'name', name: 'name' },
				{ data: 'email', name: 'email' },
				{ data: 'role', orderable: false, searchable: false, sortable: false },
				{ data: 'action', orderable: false, searchable: false, sortable: false }
			],
			columnDefs: [
				{
					targets: -1,
					orderable: false,
					searchable: false,
					sortable: false,
					render: function (data, type, full, meta) {
						return `
							<a href="${url_current_page}/${full.id}" class="btn btn-sm btn-primary"><i class="ti ti-eye"></i></a>
							<a href="${url_current_page}/${full.id}/edit" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
							<a href="${url_current_page}/${full.id}" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></a>
						`;
					}
				}
			],
			ajax: {
				url: url_current_page,
				type: 'GET',
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json'
				}
			},
			stateSave: true,
			stateSaveCallback: function (settings, data) {
				window.storageSetItem(settings.sInstance, JSON.stringify(data));
			},
			stateLoadCallback: function (settings) {
				var data = window.storageGetItem(settings.sInstance);
				return data ? JSON.parse(data) : null;
			}
		});

		$('#daftar-user-superadmin').on('click', '#btnhapus', function () {
			var tr = $(this).closest('tr');
			var data = datatable.DataTable().row(tr).data();
			$('#nama-user').text(data.name);
			$('#frmhapus').attr('action', url_current_page + '/' + data.id);
		});
	}
	
	document.addEventListener('DOMContentLoaded', function (e) {
		(function () {
			const frmdata = document.querySelector('#frmdata');
			if (frmdata !== null && frmdata !== undefined) {      
				
			}
		})();
	});

})(window, document, jQuery);