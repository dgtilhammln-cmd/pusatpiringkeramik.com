{{-- Shared Rich Text Editor Partial --}}
{{-- Usage: @include('admin.partials.rich-editor', ['name'=>'content', 'value'=>$item->content??'', 'height'=>'350px']) --}}
@php $edId = 'editor_'.Str::random(6); $haId = 'ha_'.Str::random(6); @endphp

<div style="border:1px solid rgba(255,255,255,0.08);border-radius:4px;overflow:hidden;">
  {{-- Toolbar --}}
  <div style="display:flex;flex-wrap:wrap;gap:3px;padding:.625rem .875rem;background:rgba(255,255,255,.025);border-bottom:1px solid rgba(255,255,255,.06);" id="tb_{{ $edId }}">
    @foreach([['bold','B','font-weight:800'],['italic','I','font-style:italic'],['underline','U','text-decoration:underline']] as $b)
    <button type="button" onclick="edFmt('{{$edId}}','{{$b[0]}}')" style="{{$b[2]}};padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;min-width:28px;">{{$b[1]}}</button>
    @endforeach
    <div style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></div>
    @foreach([['h2','H2'],['h3','H3'],['p','¶']] as $b)
    <button type="button" onclick="edBlock('{{$edId}}','{{$b[0]}}')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#FFD700;border-radius:3px;cursor:pointer;font-size:.78rem;font-weight:700;min-width:28px;">{{$b[1]}}</button>
    @endforeach
    <div style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></div>
    <button type="button" onclick="edFmt('{{$edId}}','insertUnorderedList')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.78rem;" title="Bullet List">
      <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><rect x="2" y="5" width="3" height="3"/><rect x="8" y="5" width="14" height="3"/><rect x="2" y="11" width="3" height="3"/><rect x="8" y="11" width="14" height="3"/><rect x="2" y="17" width="3" height="3"/><rect x="8" y="17" width="14" height="3"/></svg>
    </button>
    <button type="button" onclick="edFmt('{{$edId}}','insertOrderedList')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.78rem;" title="Numbered List">
      <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><text x="0" y="10" font-size="10">1.</text><rect x="8" y="5" width="14" height="2"/><text x="0" y="17" font-size="10">2.</text><rect x="8" y="12" width="14" height="2"/></svg>
    </button>
    <button type="button" onclick="edLink('{{$edId}}')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.78rem;" title="Insert Link">
      <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
    </button>
    <button type="button" onclick="edQuote('{{$edId}}')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.78rem;" title="Blockquote">&ldquo;</button>
    <button type="button" onclick="edCode('{{$edId}}')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.72rem;font-family:monospace;" title="Inline Code">&lt;/&gt;</button>
    <div style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></div>
    <button type="button" id="htmlbtn_{{ $edId }}" onclick="edToggleHtml('{{$edId}}','{{$haId}}')"
            style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.4);border-radius:3px;cursor:pointer;font-size:.72rem;font-family:monospace;">HTML</button>
  </div>

  {{-- Visual editor --}}
  <div id="{{ $edId }}" contenteditable="true"
       style="min-height:{{ $height ?? '320px' }};padding:1.125rem;color:#D4D4D8;font-size:.9375rem;line-height:1.85;outline:none;font-family:'Montserrat',sans-serif;"
       oninput="document.getElementById('{{ $haId }}').value=this.innerHTML;"
  >{!! $value ?? '' !!}</div>

  {{-- Hidden HTML textarea --}}
  <textarea id="{{ $haId }}" name="{{ $name }}" style="display:none;width:100%;min-height:{{ $height ?? '320px' }};padding:1.125rem;color:#D4D4D8;font-size:.8rem;line-height:1.6;font-family:'Fira Code',monospace;background:rgba(0,0,0,.3);border:none;outline:none;resize:vertical;">{{ $value ?? '' }}</textarea>
</div>

<script>
(function(){
  var edId = '{{ $edId }}', haId = '{{ $haId }}';
  var htmlMode = false;

  window.edFmt = window.edFmt || function(id, cmd) {
    document.getElementById(id).focus();
    document.execCommand(cmd, false, null);
    document.getElementById('ha_'+id.slice(7)).value = document.getElementById(id).innerHTML;
  };

  // Override for per-instance calls with full edId
  window['edFmt'] = function(id, cmd) {
    var ed = document.getElementById(id); if(!ed) return;
    ed.focus(); document.execCommand(cmd,false,null);
    var ha = document.querySelector('[id^="ha_"]'); // fallback
    // find the paired textarea by scanning for matching hidden textarea
    var allHa = document.querySelectorAll('textarea[style*="display:none"]');
    allHa.forEach(function(t){ if(t.id && document.getElementById(id).parentElement.contains(t)) { t.value = document.getElementById(id).innerHTML; }});
  };
  window['edBlock'] = function(id, tag) { document.getElementById(id).focus(); document.execCommand('formatBlock',false,tag); };
  window['edLink'] = function(id) {
    var url = prompt('URL (https://...):'); if(!url) return;
    var text = prompt('Teks link:') || url;
    document.getElementById(id).focus();
    document.execCommand('insertHTML',false,'<a href="'+url+'" target="_blank" rel="noopener">'+text+'</a>');
  };
  window['edQuote'] = function(id) {
    var sel = window.getSelection().toString() || 'Kutipan di sini...';
    document.getElementById(id).focus();
    document.execCommand('insertHTML',false,'<blockquote>'+sel+'</blockquote>');
  };
  window['edCode'] = function(id) {
    var sel = window.getSelection().toString() || 'code';
    document.getElementById(id).focus();
    document.execCommand('insertHTML',false,'<code>'+sel+'</code>');
  };
  window['edToggleHtml'] = function(edId, haId) {
    htmlMode = !htmlMode;
    var ed = document.getElementById(edId);
    var ha = document.getElementById(haId);
    var btn = document.getElementById('htmlbtn_'+edId);
    if(htmlMode) {
      ha.value = ed.innerHTML; ha.style.display='block'; ed.style.display='none';
      btn.style.color='#FFD700'; btn.style.borderColor='rgba(255,215,0,.4)';
    } else {
      ed.innerHTML = ha.value; ed.style.display='block'; ha.style.display='none';
      btn.style.color='rgba(255,255,255,.4)'; btn.style.borderColor='rgba(255,255,255,.1)';
    }
  };

  // Sync before form submit
  document.addEventListener('submit', function() {
    if(!htmlMode) {
      var ed = document.getElementById(edId);
      var ha = document.getElementById(haId);
      if(ed && ha) ha.value = ed.innerHTML;
    }
    document.getElementById(haId).style.display = 'block';
  });
})();
</script>
