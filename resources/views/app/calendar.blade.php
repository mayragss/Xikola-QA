@extends(config('app.layout'))
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-dark fw-bolder">{{__('Calendar')}}</h4>
    </div>

    <div class="card">
        <div class="card-body p-2">
            <div id="calendar"></div>
        </div>
    </div>

    @include('app.common.add-event')

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'pt-br',
      firstDay: 1, // Segunda-feira como primeiro dia da semana
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      buttonText: {
        today: 'Hoje',
        month: 'Mês',
        week: 'Semana',
        day: 'Dia',
        list: 'Lista'
      },
      allDayText: 'dia inteiro',
      moreLinkText: function(n) {
        return 'mais +' + n;
      },
      noEventsText: 'Nenhum evento para mostrar',
      // Configurações para manter compatibilidade
      height: 'auto',
      aspectRatio: 1.8,
      // Configurações de eventos
      events: function(info, successCallback, failureCallback) {
        // Carregar eventos do servidor
        fetch('{{$base_url}}/app/calendar-events?start=' + info.startStr + '&end=' + info.endStr)
          .then(response => response.json())
          .then(data => {
            successCallback(data);
          })
          .catch(error => {
            console.error('Erro ao carregar eventos:', error);
            failureCallback(error);
          });
      },
      // Permitir cliques em datas para criar eventos
      dateClick: function(info) {
        // Abrir modal de adicionar evento
        openAddEventModal(info.dateStr);
      },
      // Permitir cliques em eventos para editá-los
      eventClick: function(info) {
        // Abrir modal de editar evento
        openEditEventModal(info.event);
      }
    });
    
    calendar.render();
    
    
    // Função para abrir modal de adicionar evento
    function openAddEventModal(selectedDate = null) {
      // Verificar se existe modal de adicionar evento
      const modal = document.querySelector('#add_event_modal');
      if (modal) {
        // Limpar formulário
        const form = modal.querySelector('#form_save_event');
        if (form) {
          form.reset();
          // Limpar ID do evento para criar novo
          const eventIdInput = modal.querySelector('#input_event_id');
          if (eventIdInput) {
            eventIdInput.value = '';
          }
          // Limpar seleção de instituição
          const institutionSelect = modal.querySelector('#input_institution');
          if (institutionSelect) {
            institutionSelect.selectedIndex = 0;
          }
          // Esconder botão de deletar
          const deleteBtn = modal.querySelector('#btn_delete_event');
          if (deleteBtn) {
            deleteBtn.classList.add('d-none');
          }
        }
        
        // Preencher data se fornecida
        if (selectedDate) {
          const startInput = modal.querySelector('#input_start');
          if (startInput) {
            // Converter data para formato datetime-local
            const date = new Date(selectedDate);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            startInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
          }
        }
        
        // Mostrar modal
        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
      } else {
        // Fallback: redirecionar para página de adicionar evento
        window.location.href = '{{$base_url}}/app/add-event' + (selectedDate ? '?date=' + selectedDate : '');
      }
    }
    
    // Função para abrir modal de editar evento
    function openEditEventModal(event) {
      // Implementar edição de evento se necessário
      console.log('Editar evento:', event);
    }
    
    // Conectar formulário de salvar evento
    const saveEventForm = document.querySelector('#form_save_event');
    if (saveEventForm) {
      saveEventForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        formData.append('_token', '{{csrf_token()}}');
        
        fetch('{{$base_url}}/app/save-event', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Fechar modal
            const modal = bootstrap.Modal.getInstance(document.querySelector('#add_event_modal'));
            if (modal) {
              modal.hide();
            }
            
            // Recarregar eventos no calendário
            calendar.refetchEvents();
            
            // Mostrar mensagem de sucesso
            if (typeof showToast === 'function') {
              showToast('Evento salvo com sucesso!', 'success');
            } else {
              alert('Evento salvo com sucesso!');
            }
          } else {
            // Mostrar erro
            if (typeof showToast === 'function') {
              showToast('Erro ao salvar evento: ' + (data.message || 'Erro desconhecido'), 'error');
            } else {
              alert('Erro ao salvar evento: ' + (data.message || 'Erro desconhecido'));
            }
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          if (typeof showToast === 'function') {
            showToast('Erro ao salvar evento', 'error');
          } else {
            alert('Erro ao salvar evento');
          }
        });
      });
    }
  });
</script>
@endsection
