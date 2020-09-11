{if $msgs->isError()}
				<h4>Wystąpiły błędy: </h4>
				<ol class="err">
					{foreach $msgs->getMessage(!index) as $err}
					{strip}
					<li>{$err}</li>
					{/strip}
					{/foreach}
				</ol>
				{/if}

				{* wyświeltenie listy informacji, jeśli istnieją *}
				{if $msgs->isInfo()}
				<h4>Informacje: </h4>
				<ol class="inf">
					{foreach $msgs->getInfos() as $inf}
					{strip}
					<li>{$inf}</li>
					{/strip}
					{/foreach}
				</ol>
				{/if}
