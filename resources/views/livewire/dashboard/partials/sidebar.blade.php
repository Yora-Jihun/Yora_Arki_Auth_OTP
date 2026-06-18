 @props([
     'active' => 'attendance',
 ])

  <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
      .sidebar-item { transition: all 0.18s ease; }
      .sidebar-item:hover { background: #F3F4F6; color: #111827; }
       .sidebar-item.active {
           background: #F3F4F6;
           color: #111827;
           font-weight: 600;
           position: relative;
           padding-left: 0.75rem;
           padding-right: 0.75rem;
       }
      .sidebar-item.active::before {
          content: '';
          position: absolute;
          left: 0;
          top: 8px;
          bottom: 8px;
          width: 4px;
          height: auto;
          background: #2563EB;
          border-radius: 0 3px 3px 0;
      }
      aside::-webkit-scrollbar,
      main::-webkit-scrollbar {
          width: 5px;
      }
      aside::-webkit-scrollbar-track,
      main::-webkit-scrollbar-track {
          background: transparent;
      }
      aside::-webkit-scrollbar-thumb,
      main::-webkit-scrollbar-thumb {
          background: #2563EB;
          border-radius: 10px;
      }
      aside,
      main {
          scrollbar-width: thin;
          scrollbar-color: #2563EB transparent;
      }
  </style>

 <aside class="w-[250px] fixed left-0 top-0 h-screen bg-white border-r border-[#EAEAEA] flex flex-col z-50">
       <div class="px-3 pt-6 pb-2">
          <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 mb-5">
              <div class="w-10 h-10 bg-blue-600 flex items-center justify-center shadow-sm">
                  <span class="text-white font-bold text-sm">YA</span>
              </div>
              <span class="text-[15px] font-semibold text-gray-950 tracking-tight">Yora Arki</span>
          </a>
      </div>

      <div class="px-3 pb-4">
          <div class="relative">
              <input type="text" placeholder="Search menu..." class="w-full bg-gray-50 px-3 py-2 pl-9 text-xs text-gray-600 placeholder-gray-400 border border-gray-100 focus:outline-none focus:border-blue-300 focus:bg-white transition">
              <svg class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
              </svg>
          </div>
      </div>

     <nav class="flex-1 overflow-y-auto px-3 space-y-0.5">
         <a href="{{ route('dashboard') }}" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'dashboard' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'dashboard' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/>
             </svg>
             Dashboard
         </a>

         <a href="#" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'calendar' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'calendar' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>
             </svg>
             Calendar
         </a>

         <a href="#" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'attendance' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'attendance' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
             </svg>
             Attendance
         </a>

         <a href="#" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'planning' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'planning' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
             </svg>
             Planning
         </a>

         <a href="#" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'company' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'company' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
             </svg>
             Company
         </a>

         <a href="#" wire:navigate
            class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700 {{ $active === 'time' ? 'active' : '' }}">
             <svg class="w-[18px] h-[18px] text-gray-500 {{ $active === 'time' ? '!text-blue-600' : '' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/>
             </svg>
             Time Track
         </a>
     </nav>

     <div class="px-3 py-4 border-t border-gray-100 space-y-0.5">
         <a href="#" wire:navigate class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700">
             <svg class="w-[18px] h-[18px] text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                 <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12.01" y1="17" y2="17"/>
             </svg>
             Help
         </a>
           <a href="#" wire:navigate class="sidebar-item flex items-center gap-2.5 px-3 py-2 text-[13px] text-gray-700">
               <svg class="w-[18px] h-[18px] text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                   <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.26.604.852.997 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/>
               </svg>
               Settings
           </a>
     </div>
 </aside>
