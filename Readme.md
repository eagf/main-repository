## Omgevingen
<table>
	<tr>
		<th>Name</th>
		<th>Functional release versions</th>
		<th>Additional release versions</th>
		<th>Integration links</th>
		<th>Last database version</th>
		<th>Code branch</th>
		<th>D365 version</th>
	</tr>
		<tr style="height:120px">
		<td style="background-color:#088414"><a href="https://tax-shd-evrst-1.sandbox.operations.dynamics.com/" style="font-weight:bold;color:white;">Tax-shd</a></td>
		<td>Agile + IT1 hotfixes</td>
		<td>/</td>
		<td>StreamServe</td>
		<td>PROD -> Tax<br><p style="font-size:80%">Every sundaynight</p></td>
		<td>Hotfix branch</td>
		<td>10.0.41</td>
	</tr>
	<tr style="height:120px">
		<td style="background-color:#088414"><a href="https://sherpa-uat-upgrade.sandbox.operations.dynamics.com/" style="font-weight:bold;color:white;">UAT Upgrade</a></td>
		<td>ULD</td>
		<td>Agile, IT1 hotfixes</td>
		<td>StreamServe, ASCI</td>
		<td>PROD -> UAT Upgrade<br>30/10/'24</td>
		<td>Release branch</td>
		<td>10.0.41</td>
	</tr>
	<tr style="height:120px">
		<td style="background-color:#088414"><a href="https://goed-uat-03.sandbox.operations.eu.dynamics.com/" style="font-weight:bold;color:white;">UAT-03</a></td>
		<td>IT2</td>
		<td>Agile, ULD, IT1 hotfixes</td>
		<td style="font-weight: bold">Everything<br>except ASCI</td>
		<td>PROD -> UAT-03<br>11/12/'24</td>
		<td>Iteration2 branch</td>
		<td>10.0.41</td>
	</tr>
	<tr style="height:120px">
		<td style="background-color:#088414"><a href="https://sherpa-test-2465988b8383a0fe9aos.axcloud.dynamics.com/" style="font-weight:bold;color:white;">Test</a></td>
		<td>Status:<br>"Ready for testing"</td>
		<td>/</td>
		<td>StreamServe</td>
		<td>UAT-03 -> Test<br>12/12/'24</td>
		<td>DEVOV branch</td>
		<td>10.0.41</td>
	</tr>
</table>
<br>
<br>

----

## Timeline

::: mermaid
gantt
    title Project Roadmap
    dateFormat  YYYY-MM-DD
    
    %% Optionally exclude specific dates
    excludes 2025-01-27,2025-01-28
    
    %% Define Sections & Tasks
    section Project Initiation
    Kickoff Meeting            :kickoff, 2025-02-01, 1d
    Preliminary Scoping        :scoping, after kickoff, 3d

    section Planning
    Draft Requirements         :reqs, after scoping, 5d
    Stakeholder Review         :review, after reqs, 3d
    Finalize Requirements      :finalize, after review, 3d

    section Development
    Development Phase 1        :dev1, after finalize, 10d
    QA / Testing Phase 1       :qa1, after dev1, 5d

    section Pre-Production
    User Acceptance Testing    :uat, after qa1, 5d
    Final Bug Fixes            :fixes, after uat, 3d

    section Release
    Production Deployment      :release, after fixes, 2d
    Post-Release Validation    :validation, after release, 3d
:::
