<Wix xmlns="http://schemas.microsoft.com/wix/2006/wi">
  <Product Name="PHP" Id="<?=$product_code?>" UpgradeCode="34B67696-011A-46C7-94F8-FB450EF4CB0D"
      Language="1033" Codepage="1252" Version="<?=$version?>" Manufacturer="PHP Group">
    <Package Id="*" Keywords="Installer" Description="PHP Installer"
        Comments="Copyright © The PHP Group" Manufacturer="PHP Group"
        InstallerVersion="200" Languages="1033" Compressed="yes" SummaryCodepage="1252"/>
    <MajorUpgrade AllowSameVersionUpgrades="yes" DowngradeErrorMessage="<?=$downgrade_error?>"/>
    <Media Id="1" Cabinet="php.cab" EmbedCab="yes"/>
    <Directory Id="TARGETDIR" Name="SourceDir">
      <Directory Id="<?=$program_files?>" Name="PFiles">
        <Directory Id="INSTALLDIR" Name="PHP"/>
      </Directory>
      <Directory Id="ProgramMenuFolder" Name="Programs">
        <Directory Id="ProgramMenuDir" Name="PHP">
          <Component Id="ProgramMenuDir" Guid="D0131053-4C0D-4520-971F-42B520C3C8DD">
            <RemoveFolder Id="ProgramMenuDir" On="uninstall"/>
            <RegistryValue Root="HKCU" Key="Software\[Manufacturer]\[ProductName]" Type="string" Value="" KeyPath="yes"/>
          </Component>
        </Directory>
      </Directory>
    </Directory>
    <Icon Id="ico_php.exe" SourceFile="<?=$dir?>\php.exe"/>
<?foreach ($dirs as [$id, $parent, $name]):?>
    <DirectoryRef Id="<?=$parent?>">
      <Directory Id="<?=$id?>" Name="<?=$name?>"/>
    </DirectoryRef>
<?endforeach?>
    <Feature Id="fPhp">
      <ComponentRef Id="ProgramMenuDir"/>
<?foreach ($files as $i => [$file, $subdir, $guid]):?>
      <Component Id="cmp_<?=$i?>" Directory="<?=$subdir?>" Guid="<?=$guid?>">
        <File KeyPath="yes" Source="<?=$dir?><?=$file?>">
<?  if ($file === "\\php.exe"):?>
          <Shortcut Id="sct0" Directory="ProgramMenuDir" Name="Interactive Shell" Icon="ico_php.exe" IconIndex="0" Advertise="yes"/>
<?  endif?>
        </File>
      </Component>
<?endforeach?>
    </Feature>
    <UIRef Id="WixUI_InstallDir"/>
    <Property Id="WIXUI_INSTALLDIR" Value="INSTALLDIR"/>
    <WixVariable Id="WixUILicenseRtf" Value="<?=$license?>"/>
    <WixVariable Id="WixUIDialogBmp" Value="<?=$dialog?>"/>
    <WixVariable Id="WixUIBannerBmp" Value="<?=$banner?>"/>
  </Product>
</Wix>
